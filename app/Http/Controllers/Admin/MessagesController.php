<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\MessagesModel;
use App\Models\Admin\TaskModel;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MessagesController extends Controller
{
    public function message(Request $request, TaskModel $task)
    {
        MessagesModel::create([
            'task_id' => $task->id,
            'sender_id' => Auth::id(),
            'user_id' => User::role('admin')->first()->id,
            'message' => $request->message
        ]);

        return back();
    }
}
