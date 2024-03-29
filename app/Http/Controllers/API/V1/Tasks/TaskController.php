<?php

namespace App\Http\Controllers\API\V1\Tasks;

use App\Http\Controllers\Controller;
use App\Http\Controllers\HistoryController;
use App\Http\Controllers\Admin\TasksController;
use App\Http\Resources\API\V1\ProjectResource;
use App\Http\Resources\API\V1\Tasks\GetTasksResource;
use App\Http\Resources\API\V1\Tasks\NewTasksResource;
use App\Http\Resources\API\V1\Tasks\TasksResource;
use App\Http\Resources\API\V1\TypeResource;
use App\Http\Resources\API\V1\UserResource;
use App\Models\Admin\ProjectModel;
use App\Models\Admin\StatusesModel;
use App\Models\Admin\TaskModel;
use App\Models\Admin\TaskTypeModel;
use App\Models\Admin\UserTaskHistoryModel;
use App\Models\Client\Offer;
use App\Models\Statuses;
use App\Models\SystemIdea;
use App\Models\User;
use App\Notifications\Telegram\SendNewTaskInUser;
use App\Notifications\Telegram\TelegramUserAccept;
use App\Notifications\Telegram\TelegramUserDecline;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class TaskController extends Controller
{
    public function index()
    {
        return response([
            'message' => true,
            'tasks' => TasksResource::collection(TaskModel::where('user_id', Auth::id())->get())
        ]);
    }

    public function newTasks()
    {
        return response([
            'message' => true,
            'tasks' => NewTasksResource::collection(Auth::user()->getNewTasks(Auth::id()))
        ]);
    }

    public function getTasks()
    {
        return response([
            'message' => true,
            'tasks' => GetTasksResource::collection(Auth::user()->getUsersTasks(Auth::id())),
        ]);
    }

    public function getAllTasks()
    {
        $tasks = TaskModel::where('status_id', '!=', 3)->get();
        $statuses = StatusesModel::get();
        $projects = ProjectModel::where('pro_status', '!=', 3)->get();
        $users = User::role('user')->withTrashed()->get();

        $clients = User::role('client')->get();

        return response([
           'tasks' => new Collection($tasks),
           'statuses' => $statuses,
           'projects' => new Collection($projects),
           'users' => new Collection($users),
           'clients' => new Collection($clients)
        ]);
    }

    public function show($id)
    {
        $task = TaskModel::where('id', $id)->first();

        return response([
            'message' => true,
            'task' => new TasksResource($task)
        ]);
    }

    public function taskAccept(TaskModel $task)
    {
        UserTaskHistoryModel::create([
            'user_id' => Auth::id(),
            'task_id' => $task->id,
            'status_id' => 4,
        ]);

        $task->update([
            'status_id' => 4
        ]);

        if ($task->to < now()->toDateString()) {
            $task->status_id = 7;
            $task->save();
        }

        HistoryController::task($task->id, $task->user_id, Statuses::ACCEPT);

        if ($task->offer_id) {
            $offer = Offer::find($task->offer_id);
            $offer->status_id = 2;
            $offer->save();
            HistoryController::client($offer->id, $offer->id, $offer->client_id, Statuses::ACCEPT);
        }
        try {
            Notification::send(User::role('admin')->first(), new TelegramUserAccept($task->name, Auth::user()->name));
        } catch (\Exception $exception) {
        }
        Artisan::call('update:task-status');
        return response([
            'message' => true,
            'info' => 'Задача принята!',
            'task' => new TasksResource($task),
        ]);
    }
    public function taskDecline(TaskModel $task, Request $request)
    {
        $cancelReason = $request->input('cancel');

        if (empty($cancelReason)) {
            return response([
                'message' => false,
                'info' => 'Введите причину отмены!',
            ]);
        }
        UserTaskHistoryModel::create([
            'user_id' => Auth::id(),
            'task_id' => $task->id,
            'status_id' => 5,
        ]);
        if ($task->status_id === 7){
            $task->update([
                'status_id' => 1,
            ]);
        }

        $task->update([
            'cancel' => $request->cancel,
            'status_id' => 5,
        ]);

        HistoryController::task($task->id, $task->user_id, Statuses::DECLINED);

        if ($task->offer_id) {
            $offer = Offer::find($task->offer_id);
            $offer->cancel = $request->cancel;
            $offer->status_id = 12;
            $offer->save();
            HistoryController::client($offer->id, $offer->user_id, $offer->client_id, Statuses::DECLINED);
        }
        try {
            Notification::send(User::role('admin')->first(), new TelegramUserDecline($task->name, Auth::user()->name));
        } catch (\Exception $exception) {

        }
        Artisan::call('update:task-status');
        return response([
            'message' => true,
            'info' => 'Задача отклонено!',
        ]);
    }

    public function create()
    {
        return response([
           'message' => true,
           'users' => UserResource::collection(User::role('user')->get()),
           'projects' => ProjectResource::collection(ProjectModel::all()),
           'types' => TypeResource::collection(TaskTypeModel::all())
        ], 200);

    }

    public function store(Request $request)
    {
        $tasks = new TasksController();

        if ($request->file('file') !== null) {
            $file = $request->file('file')->store('public/docs');
        } else {
            $file = null;
        }

        $task = TaskModel::create([
            'name' => $request->name,
            'time' => $request->time,
            'from' => $request->from,
            'to' => $request->to,
            'comment' => $request->comment ?? null,
            'file' => $file ?? null,
            'file_name' => $request->file('file') ? $request->file('file')->getClientOriginalName() : null,
            'project_id' => $request->project_id,
            'type_id' => $request->type_id,
            'percent' => $request->kpi_percent,
            'kpi_id' => $request->kpi_id ?: null,
            'user_id' => $request->user_id,
            'author_id' => Auth::id(),
            'status_id' => 1,
            'client_id' => $request->client_id ?? null,
            'cancel' => $request->cancel ?? null,
            'cancel_admin' => $request->cancel_admin ?? null,
            'slug' => Str::slug($request->name . ' ' . Str::random(5)),
        ]);

        $project = ProjectModel::where('id', $request->project_id)->first();
        $project->update([
            'pro_status' => 2,
        ]);

        if ($request->user_id == Auth::id()) {
            $task->update([
                'status_id' => 1,
            ]);
        }

        $type = TaskTypeModel::find($request->type_id)->name;

        try {
            Notification::send(User::find($task->user_id), new SendNewTaskInUser($task->id, $task->name, $task->time, $task->from, $task->to, $project->finish, $type));
        } catch (\Exception $exception) {

        }

        HistoryController::task($task->id, $task->user_id, Statuses::CREATE);

        $taskResource = new TasksResource($task);

        return response()->json([
            'message' => true,
            'message_bool' => 'Задача успешно создано!',
            'task' => $taskResource,
        ], 201);
    }


    public function test() {
        $system = SystemIdea::get();

        return response()->json([
            'result' => $system
        ]);
    }

    public function update(Request $request, $id)
    {
        $task = TaskModel::find($id);

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

        return response([
            'message' => true,
            'task' => new TasksResource($task)
        ]);
    }
}
