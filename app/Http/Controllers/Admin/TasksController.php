<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\HistoryController;
use App\Models\Admin\MessagesModel;
use App\Models\Admin\ProjectModel;
use App\Models\Admin\TaskModel;
use App\Models\Admin\TaskTypeModel;
use App\Models\Admin\TaskTypesTypeModel;
use App\Models\Admin\UserTaskHistoryModel;
use App\Models\Client\Offer;
use App\Models\Statuses;
use App\Models\User;
use App\Notifications\Telegram\SendNewTaskInUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Role;

class TasksController extends BaseController
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
        $messages = MessagesModel::where('task_slug', $task->id)->orWhere([['user_id', Auth::id()], ['sender_id', Auth::id()]])->get();
        return view('admin.tasks.show', compact('task', 'messages'));
    }

    public function message(TaskModel $task, Request $request)
    {

        MessagesModel::create([
            'task_slug' => $task->slug,
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
            'percent' => $request->percent,
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
        Artisan::call('update:task-status');
        $type = TaskTypeModel::find($request->type_id)->name;
        try {
            Notification::send(User::find($task->user_id), new SendNewTaskInUser($task->id, $task->name, $task->time, $task->from, $task->finish, $project->to, $type));
        } catch (\Exception $exception) {

        }

        HistoryController::task($task->id, $task->user_id, Statuses::CREATE);
        return redirect()->route('tasks.index')->with('create', 'Задача успешно создана');
    }

    public function downloadFile(TaskModel $task)
    {


        $path = storage_path('app/public/' . $task->file);

        $headers = [
            'Content-Type' => 'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
            'Content-Disposition' => 'attachment; filename="' . $task->file_name . '"',
        ];
        return response()->download($path, $task->file_name, $headers);

    }

    public function edit(TaskModel $task)
    {
        $types = TaskTypeModel::get();
        $projects = ProjectModel::get();
        $users = User::role('user')->get();
        $type_kpi = TaskTypesTypeModel::get();
        return view('admin.tasks.edit', compact('types', 'projects', 'users', 'task', 'type_kpi'));
    }

    public function update(Request $request, TaskModel $task)
    {

        if ($request->file('file') !== null) {
            $file = $request->file('file')->store('public/docs');
        } else {
            $file = null;
        }



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
            'status_id' => 1,
            'client_id' => $request->client_id ?? null,
            'cancel' => $request->cancel ?? null,
            'cancel_admin' => $request->cancel_admin ?? null,
            'slug' => Str::slug($request->name . ' ' . Str::random(5)),
        ]);

        if ($request->type_id == 1) {
            $task->update([
                'percent' => null,
                'kpi_id' => null,
            ]);
        }

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
        return redirect()->route('tasks.index')->with('update', 'Задача успешно создана');
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

        if ($task->client_id) {
            $offer = Offer::find($task->offer_id);

            $offer->is_finished = true;
            $offer->status_id = 10;
            $offer->save();

            HistoryController::client($offer->id, Auth::id(), $offer->client_id, Statuses::SEND_TO_TEST);
        }

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
