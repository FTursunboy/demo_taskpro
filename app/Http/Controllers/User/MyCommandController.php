<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\BaseController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\HistoryController;
use App\Http\Controllers\UserBaseController;
use App\Http\Requests\User\CreateMuCommandTaskRequest;
use App\Models\Admin\MessagesModel;
use App\Models\Admin\TaskModel;
use App\Models\Admin\TaskTypeModel;
use App\Models\Admin\TaskTypesTypeModel;
use App\Models\Client\Offer;
use App\Models\History;
use App\Models\ReportHistory;
use App\Models\Statuses;
use App\Models\TeamLeadTask;
use App\Models\Types;
use App\Models\User;
use App\Notifications\Telegram\TelegramSendTaskInAdmin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class MyCommandController extends UserBaseController
{
    public function index()
    {
        $commands = new User\TeamLeadCommandModel();
        $myCommand = $commands->userInCommand(Auth::id());
        $myProject = $commands->commandProjects(Auth::id());
        $userListTasks = $commands->userTaskList(Auth::id());
        $types = TaskTypeModel::where('name', '!=', 'KPI')->get();


        return view('user.my-command.index', compact('myCommand', 'myProject', 'types', 'userListTasks'));
    }

    public function createTaskInCommand(CreateMuCommandTaskRequest $request)
    {
        $data = $request->validated();
        if ($request->file('file') !== null) {
            $file = $request->file('file')->store('public/docs');
        } else {
            $file = null;
        }
        $task = TaskModel::create([
            'name' => $data['name'],
            'time' => $data['time'],
            'type_id' => $data['type_id'],
            'from' => $data['from'],
            'to' => $data['to'],
            'comment' => $data['comment'] ?? null,
            'project_id' => $data['project_id'],
            'user_id' => $data['user_id'],
            'file' => $file ?? null,
            'file_name' => $request->file('file') ? $request->file('file')->getClientOriginalName() : null,
            'author_id' => Auth::id(),
            'status_id' => 1,
            'slug' => Str::slug($request->name . ' ' . Str::random(5)),
        ]);
        User\CreateMyCommandTaskModel::create([
            'user_id' => $data['user_id'],
            'task_id' => $task->id
        ]);
        $task->delete();
        $admin = User::role('admin')->first();
        try {
            Notification::send($admin, new TelegramSendTaskInAdmin($task->name,Auth::user()->surname .' '. Auth::user()->name));
        } catch (\Exception $exception) {
        }
        return redirect()->route('my-command.index')->with('create', 'Задача отправлена на рассмотрение Админа');
    }

    public function taskInQuery()
    {
        $TasksInQuery = TaskModel::withTrashed()
            ->where('author_id', Auth::id())
            ->whereNotNull('deleted_at')
            ->get();
        return view('user.my-command.task-in-query', compact('TasksInQuery'));
    }

    public function taskInQueryDelete($slug)
    {
        $task = TaskModel::withTrashed()->where('slug', $slug)->first();
        $copy = User\CreateMyCommandTaskModel::where([
            ['user_id', $task->user_id],
            ['task_id', $task->id]
        ])->first();
        $copy?->delete();
        $task->forceDelete();
        return back()->with('delete', 'Задача успешно удалено');
    }

    public function show($slug) {

        $task = TaskModel::where('slug', $slug)->first();

        $admin = User::role('admin')->first();

        $messages = MessagesModel::where('task_slug', $task->slug)->get();

        $reports = ReportHistory::where('task_slug', $slug)->get();
        $histories = History::where([
            ['task_id', '=', $task->id],
                ['type', '=', 'task']
        ])->get();

        $is_teamlead = TeamLeadTask::where('task_id', $task->id)->first();



        return view('user.my-command.show', compact('task', 'admin', 'messages', 'reports', 'histories', 'is_teamlead'));
    }


    public function accept($slug) {
        $task = TaskModel::where('slug', $slug)->first();

        $task->status_id = 3;
        $task->save();

        if ($task->client_id !== null) {
            $offer = Offer::find($task->offer_id);

            $offer->is_finished = true;
            $offer->status_id = 10;
            $task->status_id = 10;
            $task->save();
            $offer->save();

            HistoryController::client($offer->id, Auth::id(), $offer->client_id, Statuses::SEND_TO_TEST);
        }


       $teamlead =  TeamLeadTask::where('task_id', $task->id)->first();
       $teamlead->delete();


        return redirect()->back();




    }


    public function sendAdmin($slug) {
        $task = TaskModel::where('slug', $slug)->first();

        $task->status_id = 16;
        $task->save();

        if ($task->client_id !== null) {
            $offer = Offer::find($task->offer_id);

            if ($offer) {
                $offer->is_finished = true;
                $offer->status_id = 14;
                $offer->save();

                HistoryController::client($offer->id, Auth::id(), $offer->client_id, Statuses::SEND_TO_TEST);
            }
        }
        


        return redirect()->back();




    }
}
