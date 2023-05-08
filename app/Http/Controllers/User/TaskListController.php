<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Admin\MessagesModel;
use App\Models\Admin\TaskModel;
use App\Models\Admin\UserTaskHistoryModel;
use Database\Factories\UserFactory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskListController extends Controller
{
    public function show(TaskModel $task)
    {
        $messages = MessagesModel::where('task_id', $task->id)->orWhere([
            ['user_id', Auth::id()],
            ['sender_id', Auth::id()],
        ])->get();
        return view('user.tasks.show', compact('task', 'messages'));
    }

    public function ready(TaskModel $task)
    {
        $task->update([
            'status_id' => 6
        ]);
        return redirect()->route('user.index')->with('create', 'Задача отправлена на проверку');
    }
}
