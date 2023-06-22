<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\BaseController;
use App\Http\Controllers\HistoryController;
use App\Http\Controllers\ReportHistoryController;
use App\Http\Requests\Client\TaskRequest;
use App\Jobs\NewOfferStoreJob;
use App\Jobs\NewOfferStoreJobMake;
use App\Jobs\StoreOfferJob;
use App\Jobs\TelegranAdminSendJob;
use App\Mail\Send;
use App\Models\Admin\EmailModel;
use App\Models\Admin\MessagesModel;
use App\Models\Admin\TaskModel;
use App\Models\Client\Offer;
use App\Models\Client\Rating;
use App\Models\ClientNotification;
use App\Models\History;
use App\Models\Statuses;
use App\Models\User;
use App\Notifications\Telegram\ClientAccept;
use App\Notifications\Telegram\TelegramClientDecline;
use App\Notifications\Telegram\TelegramClientReady;
use App\Notifications\Telegram\TelegramClientTask;
use Carbon\Carbon;
use http\Client\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Str;

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

        $histories = History::where([
            ['type', '=', 'offer'],
            ['task_id', '=', $offer->id]

        ])->orderBy('created_at')->get();



        return view('client.offers.show', compact('offer', 'histories'));
    }

    public function store(TaskRequest $request)
    {
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

    public function decline(\Illuminate\Http\Request $request, Offer $offer)
    {
    

        ReportHistoryController::create(
            $offer->slug,
            Statuses::RESEND,
            $request->cancel
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
        HistoryController::task($offer->id, Auth::id(), Auth::id(), Statuses::DECLINED);

        try {
            Notification::send(User::role('admin')->first(), new TelegramClientDecline($offer->name, Auth::user()->name));
        } catch (\Exception $exception) {

        }

        return redirect()->back()->with('mess', 'Успешно отправлено!');
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

        return redirect()->back()->with('create', 'Задача успешно завершена!');
    }
}
