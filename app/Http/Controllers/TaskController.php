<?php

namespace App\Http\Controllers;

use App\Models\Admin\TasksClient;
use Dflydev\DotAccessData\Data;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index() {
        $tasks = TasksClient::get();
        return view('client.tasks.index', compact('tasks'));
    }

    public function show(TasksClient $task) {
        return view('client.tasks.show', compact('task'));
    }

    public function accept(TasksClient $task) {
        $task->status_id = 4;
        $task->save();

        return redirect()->route('client.tasks.index')->with('update', 'Принято!');
    }

    public function decline(TasksClient $task, Request $request) {

        $task->status_id = 5;
        $task->cancel = $request->cancel;
        $task->save();
        return redirect()->route('client.tasks.index')->with('update', 'Отклонено!');

    }

}
