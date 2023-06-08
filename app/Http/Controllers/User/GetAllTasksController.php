<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Admin\TasksController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\HistoryController;
use App\Models\Admin\MessagesModel;
use App\Models\Admin\ProjectModel;
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

class GetAllTasksController extends Controller
{
    public function index()
    {
        $tasks = TaskModel::where('user_id', Auth::id())->get();
        return view('user.all-tasks.index', compact('tasks'));
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
        return view('user.all-tasks.show', compact('task', 'messages', 'histories'));
    }

}
