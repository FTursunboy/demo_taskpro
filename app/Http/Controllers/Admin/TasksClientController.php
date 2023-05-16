<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseController;
use App\Http\Controllers\Controller;
use App\Models\Admin\StatusesModel;
use App\Models\Admin\TasksClient;
use App\Models\User;
use Illuminate\Http\Request;


class TasksClientController extends BaseController
{
    public function index()
    {
        $tasks = TasksClient::orderBy('created_at', 'desc')->get();

        return view('admin.tasks_client.index', compact('tasks'));
    }
    public function create()
    {
        $clients = User::role('client')->get();
        $statuses = StatusesModel::get();
        return view('admin.tasks_client.create', compact('statuses', 'clients'));
    }


    public function store(Request $request)
    {
        if ($request->file('file') !== null) {
            $file = $request->file('file')->store('public/docs');
        } else {
            $file = null;
        }
        TasksClient::create([
            'name' => $request->name,
            'from' => $request->from,
            'to' => $request->to,
            'description' => $request->description ?? null,
            'file' => $file ?? null,
            'file_name' => $request->file('file') ? $request->file('file')->getClientOriginalName() : null,
            'status_id' => 1,
            'client_id' =>$request->client_id,
            'cancel' => $request->cancel ?? null,
        ]);

        return redirect()->route('tasks_client.index')->with('create', 'Задача успешно создана!');
    }

    public function show(TasksClient $task)
    {
        return view('admin.tasks_client.show', compact('task'));
    }

    public function edit(TasksClient $task)
    {
        $clients = User::role('client')->get();
        return view('admin.tasks_client.edit', compact('task', 'clients'));
    }

    public function update(Request $request, TasksClient $task)
    {
        if ($request->file('file') !== null) {
            $file = $request->file('file')->store('public/docs');
        } else {
            $file = null;
        }
        $task->update([
            'name' => $request->name,
            'from' => $request->from,
            'to' => $request->to,
            'description' => $request->description ?? null,
            'file' => $file ?? null,
            'file_name' => $request->file('file') ? $request->file('file')->getClientOriginalName() : null,
            'status_id' => 1,
            'client_id' =>$request->client_id,
            'cancel' => $request->cancel ?? null,
        ]);

        return redirect()->route('tasks_client.index')->with('mess', 'Задача успешно обновлена!');

    }

    public function delete(TasksClient $task)
    {
        $task->delete();

        return redirect()->route('tasks_client.index')->with('mess', 'Успешно удалено!');
    }

    public function sendBack(int $id)
    {
        $task = TasksClient::findOrFail($id);
        $task->status_id = 1;
        $task->save();

        return redirect()->route('tasks_client.index')->with('mess', 'Задача успешно отправлена!');
    }
}
