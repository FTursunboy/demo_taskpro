<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\HistoryController;
use App\Http\Controllers\ReportHistoryController;
use App\Http\Controllers\Mail\MailToSendClientController;
use App\Http\Requests\Admin\TaskClientRequest;
use App\Http\Requests\Client\TaskRequest;
use App\Mail\ChatEmail;
use App\Mail\DeclineOffer;
use App\Mail\Send;
use App\Models\Admin\EmailModel;
use App\Models\Admin\MessagesModel;
use App\Models\Admin\ProjectModel;
use App\Models\Admin\TaskModel;
use App\Models\Admin\TaskTypeModel;
use App\Models\Admin\UserTaskHistoryModel;
use App\Models\Client\Offer;
use App\Models\ClientNotification;
use App\Models\History;
use App\Models\ProjectClient;
use App\Models\ReportHistory;
use App\Models\Statuses;
use App\Models\User;
use App\Notifications\Telegram\SendNewTaskInUser;
use App\Notifications\Telegram\TelegramClientTask;
use GuzzleHttp\Client;
use Illuminate\Console\View\Components\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Str;
use SebastianBergmann\CodeCoverage\Report\Xml\Project;

class OfferController extends BaseController
{
    public function index()
    {
        $offers = DB::table('offers as of')
            ->leftJoin('users as u', 'u.id', 'of.user_id')
            ->leftJoin('project_clients as pc', 'pc.user_id', 'of.client_id')
            ->leftJoin('project_models as p', 'p.id', 'pc.project_id')
            ->leftJoin('statuses_models as status', 'status.id', 'of.status_id')
            ->whereNull('of.deleted_at')
            ->where('status_id', '<>', 3)
            ->select('of.user_id', 'of.name', 'of.description', 'of.slug', 'p.name as project_name', 'status.id as status', 'status.name as status_name', 'u.name as username')
            ->orderBy('of.created_at', 'desc')
            ->get();


        return view('admin.offers.index', compact('offers'));
    }

    public function sendUserSearch(Request $request, Offer $offer, $search)
    {
        if ($_POST['action'] === 'decline') {
            $offer->status_id = 11;
            $offer->save();

            HistoryController::client($offer->id, Auth::id(), $offer->client_id, Statuses::DECLINED);

            return redirect()->route('client.offers.index')->with('update', 'Успешно отклонено!');
        }
        if ($_POST['action'] == 'refresh') {
            $offer->update([
                'user_id' => $request->user_id,
                'status_id' => 11
            ]);
            return redirect()->route('client.offers.index')->with('mess', 'Успешно отправлено!');
        }
        if ($_POST['action'] == 'accept') {
            $data = $request->validate([
                'user_id' => 'required',
                'from' => 'required',
                'to' => 'required',
                'time' => '',
            ]);

            $offer->update([
                'from' => $data['from'],
                'to' => $data['from'],
                'time' => $data['time'],
                'user_id' => $data['user_id'],
                'status_id' => 9
            ]);

            if ($offer->user_id == Auth::id()) {
                $offer->user_id = Auth::id();
                $offer->status_id = 2;
                $offer->save();
            }
            HistoryController::client($offer->id, Auth::id(), $offer->client_id, Statuses::ACCEPT);
            HistoryController::client($offer->id, Auth::id(), $offer->client_id, Statuses::SEND_USER);

            $project_id = ProjectClient::where('user_id', $offer->client_id)->first()->project_id;


            $task = TaskModel::create([
                'name' => $offer->name,
                'user_id' => $data['user_id'],
                'from' => $data['from'],
                'to' => $data['to'],
                'time' => $data['time'],
                'offer_id' => $offer->id,
                'file' => $offer->file,
                'file_name' => $offer->file_name,
                'author_id' => $offer->client_id,
                'client_id' => $offer->client_id,
                'comment' => $offer->description,
                'project_id' => $project_id,
                'status_id' => 9,
                'type_id' => $request->type_id,
                'percent' => $request->percent,
                'kpi_id' => $request->kpi_id ?: null,
                'slug' => $offer->slug,
            ]);

            if ($task->user_id == Auth::id()) {
                $task->user_id = Auth::id();
                $task->status_id = 2;
                $task->save();
            }

            HistoryController::task($task->id, $task->user_id, Statuses::CREATE);

            try {
                Notification::send(User::find($task->user_id), new SendNewTaskInUser($task->id, $task->name, $task->time, $task->from, $task->to, $task->to, 'От клиента'));
            } catch (\Exception $exception) {
            }
        }
        if (isset($search)) {
            return redirect()->route('client.offers.search.results.parameter', $search);
        }
        return redirect()->route('client.offers.index')->with('mess', 'Успешно отправлено!');

    }

    public function edit(Offer $offer)  {
        $users = User::role('user')->get();
        $clients = User::role('client')->get();

        return view('admin.offers.edit', compact('users', 'clients', 'offer'));
    }



    public function sendUser(Request $request, Offer $offer)
    {
        if ($_POST['action'] === 'decline') {
            $offer->status_id = 11;
            $offer->save();

            HistoryController::client($offer->id, Auth::id(), $offer->client_id, Statuses::DECLINED);

            return redirect()->route('client.offers.index')->with('update', 'Успешно отклонено!');
        }
        if ($_POST['action'] == 'refresh') {
            $offer->update([
                'user_id' => $request->user_id,
                'status_id' => 11
            ]);
            return redirect()->route('client.offers.index')->with('mess', 'Успешно отправлено!');
        }
        if ($_POST['action'] == 'accept') {
            $data = $request->validate([
                'user_id' => 'required',
                'from' => 'required',
                'to' => 'required',
                'time' => '',
            ]);

            $offer->update([
                'from' => $data['from'],
                'to' => $data['from'],
                'time' => $data['time'],
                'user_id' => $data['user_id'],
                'status_id' => 9
            ]);

            if ($offer->user_id == Auth::id()) {
                $offer->user_id = Auth::id();
                $offer->status_id = 2;
                $offer->save();
            }
            HistoryController::client($offer->id, Auth::id(), $offer->client_id, Statuses::ACCEPT);
            HistoryController::client($offer->id, Auth::id(), $offer->client_id, Statuses::SEND_USER);

            $project_id = ProjectClient::where('user_id', $offer->client_id)->first()->project_id;


            $task = TaskModel::create([
                'name' => $offer->name,
                'user_id' => $data['user_id'],
                'from' => $data['from'],
                'to' => $data['to'],
                'time' => $data['time'],
                'offer_id' => $offer->id,
                'file' => $offer->file,
                'file_name' => $offer->file_name,
                'author_id' => $offer->client_id,
                'client_id' => $offer->client_id,
                'comment' => $offer->description,
                'project_id' => $project_id,
                'status_id' => 9,
                'type_id' => $request->type_id,
                'percent' => $request->percent,
                'kpi_id' => $request->kpi_id ?: null,
                'slug' => $offer->slug,
            ]);

            if ($task->user_id == Auth::id()) {
                $task->user_id = Auth::id();
                $task->status_id = 2;
                $task->save();
            }

            HistoryController::task($task->id, $task->user_id, Statuses::CREATE);

            try {
                Notification::send(User::find($task->user_id), new SendNewTaskInUser($task->id, $task->name, $task->time, $task->from, $task->to, $task->to, 'От клиента'));
            } catch (\Exception $exception) {
            }
        }
        if (isset($search)) {
            return redirect()->route('client.offers.search.results.parameter', $search);
        }
        return redirect()->route('client.offers.index')->with('mess', 'Успешно отправлено!');

    }
    public  function sendClient(Offer $offer)
    {
        $offer->is_finished = true;
        $offer->status_id = 10;
        $offer->save();

        $user = User::find($offer->client_id);


        $tasks = TaskModel::where('offer_id', $offer->id)->first();

        if ($tasks !== null) {
            $tasks->status_id = 10;
            $tasks->save();
        }

        $email = $user?->clientEmail?->email;
        MailToSendClientController::send($email, $offer->name);

        HistoryController::client($offer->id, Auth::id(), $offer->client_id, Statuses::SEND_TO_TEST);

        return redirect()->back()->with('mess', 'Успешно удалено!');
    }



    public function show($slug) {

        $offer = Offer::where('slug', $slug)->first();

        $project = ProjectClient::where('user_id', $offer->client_id)->first();

        $messages = MessagesModel::where('task_slug', $offer->slug)->get();

        $users = User::role(['user', 'admin'])->get();

        $types = TaskTypeModel::get();

        $reports = ReportHistory::where('task_slug', $slug)->get();

        $histories = History::where([
            ['type', '=', 'offer'],
            ['task_id', '=', $offer->id]
        ])->get();


        return view('admin.offers.show', compact('offer', 'users', 'project', 'histories', 'messages', 'types', 'reports'));
    }

    public function showSearch(Offer $offer, $search) {
        $project = ProjectClient::where('user_id', $offer->client_id)->first();

        $messages = MessagesModel::where('task_slug', $offer->slug)->get();


        $users = User::role(['user', 'admin'])->get();

        $types = TaskTypeModel::get();


        $histories = History::where([
            ['type', '=', 'offer'],
            ['task_id', '=', $offer->id]
        ])->get();
        return view('admin.offers.show', compact('offer', 'users', 'project', 'histories', 'messages', 'types', 'search'));

    }


    public  function delete(Offer $offer)
    {
        $task = TaskModel::where('offer_id', $offer->id)->first();
        HistoryController::client($offer->id, Auth::id(), $offer->client_id, Statuses::DELETE);

        $task?->delete();
        $offer->delete();

        return redirect()->back()->with('mess', 'Успешно удалено!');
    }


    public function update(Request $request, Offer $offer)
    {
        $request->validate([
            'client_id' => 'required',
            'user_id' => '',
            'name' => 'required',
            'description' => 'required',
        ]);

        $offer->update([
            'client_id' => $request->client_id,
            'user_id' => $request->user_id,
            'name' => $request->name,
            'description' => $request->description
        ]);

        $task = TaskModel::where('offer_id', $offer->id)->first();

        if ($task) {
            $task->update([
                'client_id' => $request->client_id,
                'user_id' => $request->user_id,
                'name' => $request->name,
                'comment' => $request->description,
            ]);
        }

        HistoryController::client($offer->id, Auth::id(), $offer->client_id, Statuses::UPDATE);

        return redirect()->route('client.offers.index')->with('mess', 'Успешно отправлено!');
    }

    public function sendBack(Offer $offer, Request $request)
    {
        $task = TaskModel::where('offer_id', $offer->id)->first();

        $history = UserTaskHistoryModel::where('task_id', $task->id)->first();


        $history?->delete();

        $offer->status_id = 9;
        $offer->cancel_admin = $request->reason;
        $task->status_id = 9;
        $task->cancel_admin = $request->reason;
        $offer->save();
        $task->save();

        if ($request->input('reason1')){
            ReportHistoryController::create(
                $task->slug,
                Statuses::RESEND,
                $request->input('reason1')
            );
        }elseif ($request->input('reason')){
            ReportHistoryController::create(
                $task->slug,
                Statuses::RESEND,
                $request->input('reason')
            );
        }


        HistoryController::client($offer->id, Auth::id(), $offer->client_id, Statuses::SEND_USER);


        try {
            Notification::send(User::find($offer->user_id), new SendNewTaskInUser($task->id, $task->name, $task->time, $task->from, $task->to, $task->to, 'От клиента'));
        }
        catch (\Exception $exception) {

        }

        return redirect()->back()->with('mess', 'Успешно отправлено обратно ');
    }

    public function search(Request $request) {

        return redirect()->route('client.offers.search.results')->withInput();

    }

    public function searchResults(Request $request)
    {
        // Получение данных поиска
        $searchTerm = $request->old('search');


        // Выполнение поиска в таблице
        $offers = DB::table('offers as of')
            ->leftJoin('users as u', 'u.id', 'of.user_id')
            ->leftJoin('project_clients as pc', 'pc.user_id', 'of.client_id')
            ->leftJoin('project_models as p', 'p.id', 'pc.project_id')
            ->leftJoin('statuses_models as status', 'status.id', 'of.status_id')
            ->select('of.*', 'p.name as project_name', 'status.id as status', 'status.name as status_name', 'u.name as username')
            ->where(function ($query) use ($searchTerm) {
                $query->where('of.name', 'like', '%'.$searchTerm.'%')
                    ->orWhere('p.name', 'like', '%'.$searchTerm.'%')
                    ->orWhere('u.name', 'like', '%'.$searchTerm.'%')
                    ->orWhere('of.description', 'like', '%'.$searchTerm.'%');
            })
            ->whereNull('of.deleted_at')
            ->orderBy('of.created_at', 'desc')
            ->get();




        return view('admin.offers.index', ['offers' => $offers, 'search' => $searchTerm]);
    }

    public function searchResultsWithparametr($search)
    {

        $searchTerm = $search;


        $offers = DB::table('offers as of')
            ->leftJoin('users as u', 'u.id', 'of.user_id')
            ->leftJoin('project_clients as pc', 'pc.user_id', 'of.client_id')
            ->leftJoin('project_models as p', 'p.id', 'pc.project_id')
            ->leftJoin('statuses_models as status', 'status.id', 'of.status_id')
            ->select('of.*', 'p.name as project_name', 'status.id as status', 'status.name as status_name', 'u.name as username')
            ->where(function ($query) use ($searchTerm) {
                $query->where('of.name', 'like', '%'.$searchTerm.'%')
                    ->orWhere('p.name', 'like', '%'.$searchTerm.'%')
                    ->orWhere('u.name', 'like', '%'.$searchTerm.'%');
            })
            ->whereNull('of.deleted_at')
            ->orderBy('of.created_at', 'desc')
            ->get();





        return view('admin.offers.index', ['offers' => $offers, 'search' => $searchTerm, 'mess' => 'Успешно отправлено']);
    }


    public function filter($user, $status, $project) {
        $offers = DB::table('offers as of')
            ->leftJoin('users as u', 'u.id', 'of.user_id')
            ->leftJoin('project_clients as pc', 'pc.user_id', 'of.client_id')
            ->leftJoin('project_models as p', 'p.id', 'pc.project_id')
            ->leftJoin('statuses_models as status', 'status.id', 'of.status_id')
            ->select('of.*', 'p.name as project_name', 'status.id as status', 'status.name as status_name', 'u.name as username')
            ->whereNull('of.deleted_at')
            ->orderBy('of.created_at', 'desc')
            ->get();

    }

    public function decline(Request $request, Offer $offer) {
        $offer->cancel_admin = $request->reason;
        $offer->status_id = 11;
        $offer->save();
        $user = User::find($offer->client_id);
        $email = $user?->clientEmail?->email;

        ReportHistoryController::create(
            $offer->slug,
            Statuses::DECLINED,
            $request->input('reason')
        );

        if ($email) {
            Mail::to($email)->send(new DeclineOffer($offer->name, $offer->cancel_admin));
        }
        return redirect()->route('client.offers.index')->with('mess', 'Успешно отправлено');
    }

    public function create()
    {
        $offers = User::role('client')->get();

        return view('admin.offers.create', compact('offers'));
    }

    public function store(TaskClientRequest $request)
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

        $offer = Offer::create([
            'name' => $request->name,
            'description' => ($request->description === null)? null:$request->description,
            'author_name' => $request->author_name,
            'author_phone' => $request->author_phone,
            'file' => $file,
            'file_name' => $file_name,
            'status_id' => 8,
            'client_id' => $request->client_id,
            'slug' => Str::slug($request->name . ' ' . Str::random(5), '-'),
        ]);

        ClientNotification::create([
            'offer_id' => $offer->id
        ]);


        HistoryController::client($offer->id, Auth::id(), Auth::id(), 2);



        return redirect()->route('client.offers.index')->with('create', 'Успешно создано!');

    }

}
