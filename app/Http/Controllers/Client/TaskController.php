<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\BaseController;
use App\Http\Controllers\HistoryController;
use App\Http\Controllers\ReportHistoryController;
use App\Http\Requests\Client\TaskRequest;
use App\Jobs\NewOfferStoreJobMake;
use App\Jobs\TelegranAdminSendJob;
use App\Models\Admin\MessagesModel;
use App\Models\Admin\TaskModel;
use App\Models\Client\Offer;
use App\Models\History;
use App\Models\ReportHistory;
use App\Models\Statuses;
use App\Models\User;
use App\Notifications\Telegram\ClientAccept;
use App\Notifications\Telegram\TelegramClientDecline;
use App\Notifications\Telegram\TelegramClientReady;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Notification;
use Illuminate\Http\Request;

class TaskController extends BaseController
{
    public function index()
    {
        $tasks = Offer::where([
            ['client_id', '=', Auth::id()],
        ])->get();


        return view('client.offers.index', compact('tasks'));
    }


    public function show($slug) {

        $offer = Offer::where('slug', $slug)->first();
        $reports = ReportHistory::where('task_slug', $slug)->get();


        $histories = History::where([
            ['type', '=', 'offer'],
            ['task_id', '=', $offer->id]

        ])->orderBy('created_at')->get();



        return view('client.offers.show', compact('offer', 'histories', 'reports'));
    }
    public function show_ready() {
        $tasks = Offer::where([
            ['client_id', '=', Auth::id()],
        ])->where('status_id', '=', 10)->get();

        return view('client.offers.index', compact('tasks'));
    }

    public function show_done() {
        $tasks = Offer::where([
            ['client_id', '=', Auth::id()],
        ])->where('status_id', '=', 3)->get();
        return view('client.offers.index', compact('tasks'));
    }

    public function show_progress() {
        $tasks = Offer::where([
            ['client_id', Auth::id()]
        ])->whereIn('status_id', [2, 7])->get();

        return view('client.offers.index', compact('tasks'));
    }

    public function store(TaskRequest $request)
    {
        $project = DB::table('project_clients as pc')
            ->join('project_models as p','p.id', 'pc.project_id')
            ->join('users as u', 'u.id', 'pc.user_id')
            ->select('p.is_active')
            ->where('u.id', Auth::id())
            ->first();
        if (!$project->is_active) {
            return redirect()->route('client.index')->with('error', 'Ваш договор СОПР не активен');
        }


        $request->validated();

        if (isset($request->file)) {
            $upload_file = $request->file('file');
            $file_name = $upload_file->getClientOriginalName();
            $file = $request->file('file')->store('public/docs');
        } else {
            $file = null;
            $file_name = null;
        }


        NewOfferStoreJobMake::dispatch(
            $request->except('file'),
            $file,
            $file_name,
            Auth::id()
        );

        TelegranAdminSendJob::dispatch($request->name, Auth::user()->name);



        return redirect()->route('offers.index')->with('create', 'Успешно создано!');

    }


    public function update(TaskRequest $request, Offer $offer)
    {
        $request->validated();

        if (isset($request->file)) {
            $upload_file = $request->file('file');
            $file_name = $upload_file->getClientOriginalName();
            $file = $request->file('file')->store('public/docs');
            $offer->file = $file;
            $offer->file_name = $file_name;
        }

        $offer->name = $request->name;
        $offer->description = $request->description;
        $offer->author_name = $request->author_name;
        $offer->author_phone = $request->author_phone;
        $offer->client_id = Auth::id();

        $offer->save();

        $task = TaskModel::where('offer_id', $offer->id)->first();

        if ($task) {
            $task->name = $request->name;
            $task->comment = $request->description;
            $task->file = $request->file('file')->store('public/docs');
            $task->file_name = $upload_file->getClientOriginalName();
            $task->save();
        }

        HistoryController::client($offer->id, Auth::id(), Auth::id(), 8);
        return redirect()->route('offers.index')->with('update', 'Успешно обновлено!');
    }

    public function delete(Offer $offer)
    {
        $offer->delete();
        $user = User::role('admin')->first();
        HistoryController::client($offer->id, Auth::id(), Auth::id(), 9);
        return redirect()->back()->with('mess', 'Успешно удалено!');
    }

    public function confirm(Offer $offer)
    {
        $offer->status_id = 3;
        $offer->finish = Carbon::now();
        $tasks = TaskModel::where('offer_id', $offer->id)->first();
        if ($tasks !== null) {
            $tasks->status_id = 3;
            $tasks->save();
        }
        $offer->save();
        $user = User::role('admin')->first();
        HistoryController::client($offer->id, Auth::id(), Auth::id(), 5);
        $task = TaskModel::where('offer_id', $offer->id)->first();
        if ($task) {
            HistoryController::task($task->id, $task->user_id, Statuses::DECLINED);
        }
        return redirect()->back()->with('mess', 'Успешно отправлено!');
    }

    public function decline(Request $request, Offer $offer)
    {
        ReportHistoryController::create(
            $offer->slug,
            Statuses::RESEND,
            $request->reason
        );


        $offer->status_id = 13;
        $offer->is_finished = false;
        $offer->save();
        $tasks = TaskModel::where('offer_id', $offer->id)->first();
        if ($tasks !== null) {
            $tasks->status_id = 13;
            $tasks->save();
        }

        HistoryController::client($offer->id, Auth::id(), Auth::id(), Statuses::DECLINED);

        $task = TaskModel::where('offer_id', $offer->id)->first();
        if ($task) {
            HistoryController::task($task->id, $task->user_id, Statuses::DECLINED);
        }


        try {
            Notification::send(User::role('admin')->first(), new TelegramClientDecline($offer->name, Auth::user()->name));
        } catch (\Exception $exception) {

        }

        return redirect()->route('offers.index')->with('create', 'Успешно отклонено!');
    }

    public function downloadFile(Offer $offer)
    {
        $path = storage_path('app/' . $offer->file);

        $headers = [
            'Content-Type' => 'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
            'Content-Disposition' => 'attachment; filename="' . $offer->file_name . '"',
        ];

        return response()->download($path, $offer->file_name, $headers);
    }


    public function download_file_chat(MessagesModel $messagesModel)  {
        $path = storage_path('app/public/' . $messagesModel->file);

        $headers = [
            'Content-Type' => 'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
            'Content-Disposition' => 'attachment; filename="' . $messagesModel->file_name . '"',
        ];

        return response()->download($path, $messagesModel->file_name, $headers);

    }

    public function ready(Offer $offer)
    {

        $offer->status_id = 3;
        $user = User::find($offer->user_id);

        $user->xp += 10;
        $user->save();
        $offer->finish = Carbon::now();
        $offer->save();


        try {
            Notification::send($user, new ClientAccept($offer));
        } catch (\Exception $exception) {
        }


        $tasks = TaskModel::where('offer_id', $offer->id)->first();
        if ($tasks !== null) {
            $tasks->status_id = 3;
            $tasks->save();
            HistoryController::task($tasks->id, $tasks->user_id, Statuses::FINISH);
        }



        HistoryController::client($offer->id, Auth::id(), Auth::id(), 5);


        try {
            Notification::send(User::role('admin')->first(), new TelegramClientReady($offer->name, Auth::user()->name));
        } catch (\Exception $exception) {

        }

        return redirect()->route('offers.index')->with('create', 'Задача готова. Спасибо за оценку');
    }

}
