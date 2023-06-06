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
use App\Models\History;
use App\Models\Statuses;
use App\Models\User;
use App\Notifications\Telegram\SendNewTaskInUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class MonitoringController extends BaseController
{
    public function index()
    {
        $task = new TasksController();
        $task->check();
        $tasks = TaskModel::get();
        $statuses = StatusesModel::get();
        $projects = ProjectModel::get();
        $users = User::role('user')->get();
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


    public function show(TaskModel $task)
    {
        $messages = MessagesModel::where('task_slug', $task->slug)
            ->orWhere([
                ['user_id', Auth::id()],
                ['sender_id', Auth::id()]
            ])->get();

        $histories = History::where([
            ['task_id', '=', $task->id],
            ['type', '=', 'task']
        ])->get();

        return view('admin.monitoring.show', compact('task', 'messages', 'histories'));
    }

    public function edit(TaskModel $task)
    {
        $types = TaskTypeModel::get();
        $projects = ProjectModel::get();
        $users = User::role('user')->get();
        $type_kpi = TaskTypesTypeModel::get();

        return view('admin.monitoring.edit', compact('types', 'projects', 'users', 'task', 'type_kpi'));
    }

    public function update(Request $request, TaskModel $task)
    {
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

        if ($request->type_id != 2) {
            $task->update([
                'percent' => null,
                'kpi_id' => null,
            ]);
        }

        $project = ProjectModel::where('id', $request->project_id)->first();
        $project->update([
            'pro_status' => 2,
        ]);

        $type = TaskTypeModel::find($request->type_id)?->name;
        try {
            Notification::send(User::find($task->user_id), new SendNewTaskInUser($task->id, $task->name, $task->time, $task->from, $task->finish, $project->to, $type));
        } catch (\Exception $exception) {

        }

        HistoryController::task($task->id, $task->user_id, Statuses::UPDATE);

        $task1 = new TasksController();

        $task1->check();
        return redirect()->route('mon.index')->with('update', 'Задача успешно обновлена');
    }

}
