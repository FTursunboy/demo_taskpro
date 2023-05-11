<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\HistoryController;
use App\Models\Admin\MessagesModel;
use App\Models\Admin\ProjectModel;
use App\Models\Admin\TaskModel;
use App\Models\Admin\TaskTypeModel;
use App\Models\Admin\TaskTypesTypeModel;
use App\Models\Admin\UserTaskHistoryModel;
use App\Models\Statuses;
use App\Models\User;
use App\Notifications\Telegram\SendNewTaskInUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;

class TasksController extends Controller
{
    public function index()
    {
        $tasks = TaskModel::orderBy('created_at', 'desc')->get();
        return view('admin.tasks.index', compact('tasks'));
    }

    public function create()
    {
        $types = TaskTypeModel::get();
        $projects = ProjectModel::get();
        $users = User::role('user')->get();
        return view('admin.tasks.create', compact('types', 'projects', 'users'));
    }

    public function show(TaskModel $task)
    {
        $messages = MessagesModel::where('task_id', $task->id)->orWhere([['user_id', Auth::id()], ['sender_id', Auth::id()]])->get();
        return view('admin.tasks.show', compact('task', 'messages'));
    }

    public function message(TaskModel $task, Request $request)
    {
        MessagesModel::create([
            'task_id' => $task->id,
            'sender_id' => Auth::id(),
            'user_id' => $task->user_id,
            'message' => $request->message
        ]);

        return back();
    }

    public function store(Request $request)
    {

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
            'kpi_id' => $request->kpi_id ?: null,
            'user_id' => $request->user_id,
            'author_id' => Auth::id(),
            'status_id' => 1,
            'client_id' => $request->client_id ?? null,
            'cancel' => $request->cancel ?? null,
            'cancel_admin' => $request->cancel_admin ?? null,
        ]);
        $project = ProjectModel::where('id', $request->project_id)->first();
        $project->update([
            'pro_status' => 2,
        ]);
        Artisan::call('update:task-status');
        $type = TaskTypeModel::find($request->type_id)->name;
        try {
            Notification::send(User::find($task->user_id), new SendNewTaskInUser($task->id, $task->name, $task->time, $task->from, $task->finish, $project->to, $type));
        } catch (\Exception $exception) {

        }

        HistoryController::task($task->id, $task->user_id, Statuses::CREATE);
        return redirect()->route('tasks.index')->with('create', 'Задача успешно создана');
    }

    public function ready(TaskModel $task)
    {
        UserTaskHistoryModel::create([
            'user_id' => $task->user_id,
            'task_id' => $task->id,
            'status_id' => 3,
        ]);
        $task->update([
            'status_id' => 3
        ]);
        HistoryController::task($task->id, $task->user_id, Statuses::FINISH);

        return redirect()->route('tasks.index')->with('create', 'Садача готова');
    }

    public function destroy(TaskModel $task)
    {
        $task->delete();
        HistoryController::task($task->id, $task->user_id, Statuses::DELETE);

        return back()->with('delete', 'Задача успешна удалена!');
    }

    // For Ajax query
    public function kpi($id)
    {
        return TaskTypesTypeModel::where('typeTask_id', $id)->select('id', 'name')->get();
    }
}
