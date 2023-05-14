<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\StatusesModel;
use App\Models\Admin\TasksClient;
use Illuminate\Http\Request;


class TasksClientController extends Controller
{
    public function index()
    {
        $tasks = TasksClient::orderBy('created_at', 'desc')->get();

        return view('admin.tasks_client.index', compact('tasks'));
    }

    public function create()
    {
        $statuses = StatusesModel::get();
        return view('admin.tasks_client.create', compact('statuses'));
    }


    public function store(Request $request)
    {
        if ($request->file('file') !== null) {
            $file = $request->file('file')->store('public/docs');
        } else {
            $file = null;
        }
        $task = TasksClient::create([
            'name' => $request->name,
            'from' => $request->from,
            'to' => $request->to,
            'description' => $request->description ?? null,
            'file' => $file ?? null,
            'file_name' => $request->file('file') ? $request->file('file')->getClientOriginalName() : null,
            'status_id' => 1,
            'cancel' => $request->cancel ?? null,
        ]);

        return redirect()->route('tasks_client.index')->with('create', 'Задача успешно создана');
    }

    public function edit()
    {

    }

    public function update()
    {

    }

    public function delete()
    {

    }
}
