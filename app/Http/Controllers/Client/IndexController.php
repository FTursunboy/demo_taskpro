<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\BaseController;
use App\Http\Controllers\Controller;
use App\Models\Admin\TaskModel;
use App\Models\Admin\TasksClient;
use App\Models\ChatMessageModel;
use App\Models\Client\Offer;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IndexController extends BaseController
{

    public function index()
    {
        $task = User::where('id', Auth::id())->first()->countTasks(Auth::id());
        $all = Offer::where('client_id', Auth::id())->count();
        $ready = Offer::where('status_id', 3)
        ->where('client_id', Auth::id())->count();
        $inProgress = Offer::where('status_id', 2)
        ->where('client_id', Auth::id())->count();


        return view('client.index', compact('task', 'all', 'ready', 'inProgress'));
    }

    public function verificate_tasks()
    {
        $tasks = Offer::where([
            ['client_id', '=', Auth::id()],
            ['status_id', '=', '10'],
        ])->get();
        return view('client.verificate_tasks', compact('tasks'));
    }

    public function removeNotification(TaskModel $task)
    {
        $mess = ChatMessageModel::where('task_id', $task->id)->first();
        $mess?->delete();
        return redirect()->route('offers.chat', $task->id);
    }

    public function ready()
    {
        $ready = Offer::where('status_id', 3)
            ->where('client_id', Auth::id())->get();

        return view('client.ready', compact('ready'));
    }

    public function inProgress()
    {
        $inProgress = Offer::where('status_id', 2)
            ->where('client_id', Auth::id())->get();

        return view('client.inProgress', compact('inProgress'));
    }
}
