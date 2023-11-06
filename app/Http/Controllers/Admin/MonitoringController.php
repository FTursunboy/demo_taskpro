<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\HistoryController;
use App\Models\Admin\MessagesModel;
use App\Models\Admin\ProjectModel;
use App\Models\Admin\StatusesModel;
use App\Models\Admin\TaskModel;
use App\Models\Admin\TaskTypeModel;
use App\Models\Admin\TaskTypesTypeModel;
use App\Models\Admin\UserTaskHistoryModel;
use App\Models\Client\Offer;
use App\Models\History;
use App\Models\ReportHistory;
use App\Models\Statuses;
use App\Models\User;
use App\Notifications\Telegram\SendNewTaskInUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class  MonitoringController extends BaseController
{
    public function index()
    {
        $tasks = TaskModel::where('status_id', '!=', 3)->with('project', 'author', 'type', 'status', 'user')->get();
        $statuses = StatusesModel::get();
        $projects = ProjectModel::where('pro_status', '!=', 3)->get();
        $users = User::role('user')->withTrashed()->get();
        $clients = User::role('client')->get();

        return view('admin.monitoring.index', compact('tasks', 'statuses', 'projects', 'users', 'clients'));
    }

    public function filter($status,  $user, $client, $project)
    {
        try {
            $query = TaskModel::with(['author', 'project', 'user', 'client', 'status', 'type', 'typeType'])
                ->when($status !== '0', fn($query) => $query->where('status_id', $status))
                ->when($user !== '0', fn($query) => $query->where('user_id', $user))
                ->when($client !== '0', fn($query) => $query->where('client_id', $client))
                ->when($project !== '0', fn($query) => $query->where('project_id', $project))
                ->get();

            return $query;

        } catch (\Exception $exception) {
            return [
                'error' => $exception->getMessage(),
                'status' => false
            ];
        }

    }


    public function show($slug)
    {
       $task = TaskModel::where('slug', $slug)->with('user', 'project', 'status', 'type', 'typeType', 'author')->first();
       $messages = MessagesModel::where('task_slug', $task->slug)->with('sender')->get();
       $reports = ReportHistory::where('task_slug', $slug)->with('user')->get();

        $offer = Offer::where('slug', $task->slug)->first();
        if ($offer !== null) {

            $histories = History::where([
                ['task_id', '=', $offer->id],
                ['type', '=', 'offer']
            ])->with('user', 'status', 'sender')->get();
            $users = User::role('user')->get();

            return view('admin.monitoring.show', compact('task', 'messages', 'histories', 'users', 'reports'));
        }
        else {
            $histories_task = History::where([
                ['task_id', '=', $task->id],
                ['sender_id', '!=', 'null']
            ])->get();
        }

        $users = User::withTrashed()->role('user')->get();

        return view('admin.monitoring.show', compact('task', 'messages', 'histories_task', 'users', 'reports'));
    }

    public function edit($slug)
    {
        $task = TaskModel::where('slug', $slug)->first();

        $types = TaskTypeModel::get();
        $projects = ProjectModel::where('pro_status', '!=', 3)->get();
        $users = User::role(['user', 'admin'])->get();
        $type_kpi = TaskTypesTypeModel::get();

        return view('admin.monitoring.edit', compact('types', 'projects', 'users', 'task', 'type_kpi'));
    }

    public function update(Request $request, $slug)
    {
        $task = TaskModel::where('slug', $slug)->first();

        $file = $task->file;

        if ($request->hasFile('file')) {
            $newFile = $request->file('file')->store('public/docs/');
            if ($newFile !== $file) {
                if ($file !== null) {
                    Storage::delete($file);
                }
                $file = $newFile;
            }
        }
        $history = UserTaskHistoryModel::where([
            ['user_id', $task->user_id],
            ['task_id', $task->id]
        ])->first();

            $task->update([
                'name' => $request->name,
                'time' => $request->time,
                'from' => $request->from,
                'to' => $request->to,
                'comment' => $request->comment ?? null,
                'file' => $file ?? null,
                'file_name' => $request->file('file') ? $request->file('file')->getClientOriginalName() : null,
                'project_id' => $request->project_id,
                'type_id' => $request->type_id,
                'percent' => $request->percent,
                'kpi_id' => $request->kpi_id ?: null,
                'user_id' => $request->user_id,
                'author_id' => Auth::id(),
                'status_id' => ($history === null) ? 1 : $task->status_id,
                'client_id' => $request->client_id ?? null,
                'cancel' => $request->cancel ?? null,
                'cancel_admin' => $request->cancel_admin ?? null,
            ]);
            if (isset($history)) {
                if ($history?->user_id != $task->user_id) {

                    $history?->delete();

                   $task->status_id = 1;
                   $task->save();


                    try {
                        Notification::send(User::find($task->user_id), new SendNewTaskInUser($task->id, $task->name, $task->time, $task->from, $task->to, $task->finish, $task->type->name));
                    } catch (\Exception $exception) {

                    }
                }
            }

            if ($request->type_id != 2) {
                $task->update([
                    'percent' => null,
                    'kpi_id' => null,
                ]);
            }

            $offer = Offer::where('id', $task->offer_id)->first();

            if ($offer){
                $offer->name = $request->name;
                $offer->description = $request->comment ?? null;
                $offer->file = $file ?? null;
                $offer->file_name = $request->file('file') ? $request->file('file')->getClientOriginalName() : null;
                $offer->user_id = $request->user_id;
                $offer->from = $task->from;
                $offer->to = $task->to;
                $offer->save();
            }

        $project = ProjectModel::where('id', $request->project_id)->first();
        $project->update([
            'pro_status' => 2,
        ]);

        $type = TaskTypeModel::find($request->type_id)?->name;


        HistoryController::task($task->id, $task->user_id, Statuses::UPDATE);

        $admin = User::role('admin')->first();

        if ($request->user_id == $admin->id) {
            $task->update([
                'status_id' => 2,
            ]);
        }

        return redirect()->route('mon.index')->with('update', 'Задача успешно обновлена');
    }

    public function delete(TaskModel $task) {
        $task->delete();
        return redirect()->route('mon.index')->with('mess', 'Успешно удалено');
    }


    public function ready() {
        $tasks = TaskModel::where('status_id', 3)->with('project', 'author', 'type', 'status', 'user')->get();
        $statuses = StatusesModel::get();
        $projects = ProjectModel::where('pro_status', '!=', 3)->get();
        $users = User::role('user')->get();
        $clients = User::role('client')->get();
        return view('admin.monitoring.index', compact('tasks', 'statuses', 'projects', 'users', 'clients'));
    }

    public function progress()
    {
        $tasks = TaskModel::where('status_id', 2)->orWhere('status_id', 4)->with('project', 'author', 'type', 'status', 'user')->get();
        $statuses = StatusesModel::get();
        $projects = ProjectModel::where('pro_status', '!=', 3)->get();
        $users = User::role('user')->get();
        $clients = User::role('client')->get();
        return view('admin.monitoring.index', compact('tasks', 'statuses', 'projects', 'users', 'clients'));
    }

    public function clientVerification()
    {
        $tasks = TaskModel::where('status_id', 10)->with('project', 'author', 'type', 'status', 'user')->get();
        $statuses = StatusesModel::get();
        $projects = ProjectModel::where('pro_status', '!=', 3)->get();
        $users = User::role('user')->get();
        $clients = User::role('client')->get();
        return view('admin.monitoring.index', compact('tasks', 'statuses', 'projects', 'users', 'clients'));
    }

    public function adminVerification()
    {

        $tasks = TaskModel::where('status_id', 6)->orWhere('status_id', 14)->with('project', 'author', 'type', 'status', 'user')->get();
        $statuses = StatusesModel::get();
        $projects = ProjectModel::where('pro_status', '!=', 3)->get();
        $users = User::role('user')->get();
        $clients = User::role('client')->get();
        return view('admin.monitoring.index', compact('tasks', 'statuses', 'projects', 'users', 'clients'));
    }

    public function out_of_date()
    {
        $tasks = TaskModel::where('status_id', 7)->with('project', 'author', 'type', 'status', 'user')->get();
        $statuses = StatusesModel::get();
        $projects = ProjectModel::where('pro_status', '!=', 3)->get();
        $users = User::role('user')->get();
        $clients = User::role('client')->get();
        return view('admin.monitoring.index', compact('tasks', 'statuses', 'projects', 'users', 'clients'));
    }

    public function all() {
        $tasks = TaskModel::with('project', 'author', 'type', 'status', 'user')->get();
        $statuses = StatusesModel::get();
        $projects = ProjectModel::where('pro_status', '!=', 3)->get();
        $users = User::role('user')->get();
        $clients = User::role('client')->get();
        return view('admin.monitoring.index', compact('tasks', 'statuses', 'projects', 'users', 'clients'));
    }

    public function archive($slug)
    {
        $task = TaskModel::where('slug', $slug)->first();

        $task->update([
           'status_id' => 3,
        ]);

        HistoryController::task($task->id, $task->user_id, Statuses::ARCHIVE);

        return redirect()->route('mon.index')->with('mess', 'Успешно архивирована');
    }

    public function otkat($id) {
        $task = TaskModel::find($id);
        $task->status_id = 6;
        $task->save();

        if ($task->offer_id) {
            $offer = Offer::find($task->offer_id);
            $offer->status_id = 6;
            $offer->save();
        }

        return redirect()->back()->with('mess', 'Успешно');
    }

}
