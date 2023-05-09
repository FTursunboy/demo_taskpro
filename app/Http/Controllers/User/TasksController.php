<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Admin\TaskModel;
use App\Models\Admin\UserTaskHistoryModel;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TasksController extends Controller
{
    public function index()
    {
        $tasks = User::findOrFail(Auth::id())->getNewTasks(Auth::id());
        return view('user.task.index', compact('tasks'));
    }

    public function accept(TaskModel $task)
    {
        UserTaskHistoryModel::create([
            'user_id' => Auth::id(),
            'task_id' => $task->id,
            'status_id' => 4,
        ]);
        $task->update([
            'status_id' => 4
        ]);
        return back()->with('create', 'Задача принята');
    }


    public function decline(Request $request,TaskModel $task)
    {

        UserTaskHistoryModel::create([
            'user_id' => Auth::id(),
            'task_id' => $task->id,
            'status_id' => 5,
        ]);
        $task->update([
            'cancel' => $request->cancel,
            'status_id' => 5,
        ]);
        return back()->with('error', 'Задача откланена');
    }
}
