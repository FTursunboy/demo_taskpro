<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseController;
use App\Http\Controllers\Controller;
use App\Models\Admin\MessagesModel;
use App\Models\Admin\TaskModel;
use App\Models\Client\Offer;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MessagesController extends BaseController
{
    public function message(Request $request, TaskModel $task)
    {
        $user_id = User::role('admin')->first();

        MessagesModel::create([
            'task_slug' => $task->slug,
            'sender_id' => Auth::id(),
            'user_id' => ($task->offer_id !== null) ? $task->client_id : $user_id->id,
            'message' => $request->message
        ]);

        return back();
    }
}
