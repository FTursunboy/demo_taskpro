<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\BaseController;
use App\Http\Controllers\Controller;
use App\Models\Admin\TaskModel;
use App\Models\ChatMessageModel;
use App\Models\Client\Offer;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IndexController extends BaseController
{
    public function index()
    {
        $tasks = Offer::where([
            ['client_id', '=', Auth::id()],
            ['status_id', '=', '10'],
        ])->orWhere([
            ['client_id', '=', Auth::id()],
            ['status_id', '=', '6'],
        ])->orWhere([
            ['client_id', '=', Auth::id()],
            ['status_id', '=', '3'],
        ])->get();
        return view('client.index', compact('tasks'));
    }

    public function removeNotification(TaskModel $task)
    {
        $mess = ChatMessageModel::where('task_id', $task->id)->first();
        $mess?->delete();
        return redirect()->route('offers.chat', $task->id);
    }

}
