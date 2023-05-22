<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\BaseController;
use App\Http\Controllers\Controller;
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


}
