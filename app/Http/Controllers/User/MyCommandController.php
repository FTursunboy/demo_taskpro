<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\BaseController;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\CreateMuCommandTaskRequest;
use App\Models\Admin\MessagesModel;
use App\Models\Admin\TaskModel;
use App\Models\Admin\TaskTypeModel;
use App\Models\Admin\TaskTypesTypeModel;
use App\Models\History;
use App\Models\ReportHistory;
use App\Models\Types;
use App\Models\User;
use App\Notifications\Telegram\TelegramSendTaskInAdmin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class MyCommandController extends BaseController
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

        return view('user.my-command.show', compact('task', 'admin', 'messages', 'reports', 'histories'));
    }
}
