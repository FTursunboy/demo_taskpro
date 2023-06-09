<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\BaseController;
use App\Http\Controllers\Controller;
use App\Models\Admin\MessagesModel;
use App\Models\Admin\TaskModel;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IndexController extends BaseController
{

    public function index()
    {
        $task = User::where('id', Auth::id())->first()->countTasks(Auth::id());
        $user = User::where('id', Auth::id())->first();
        $tasks = User::findOrFail(Auth::id())->getUsersTasks(Auth::id());
        return view('user.index', compact('task', 'user', 'tasks'));
    }

    public function downloadFile(TaskModel $task)
    {
        $path = storage_path('app/' . $task->file);
        $headers = [
            'Content-Type' => 'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
            'Content-Disposition' => 'attachment; filename="' . $task->file_name . '"',
        ];

        return response()->download($path, $task->file_name, $headers);
    }

    public function downloadFileChat(MessagesModel $task)
    {
        $path = storage_path('app/' . $task->file);
        $headers = [
            'Content-Type' => 'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
            'Content-Disposition' => 'attachment; filename="' . $task->file_name . '"',
        ];

        return response()->download($path, $task->file_name, $headers);
    }

}
