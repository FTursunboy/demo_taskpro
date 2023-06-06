<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Admin\TaskModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GetAllTasksController extends Controller
{
    public function index()
    {
        $tasks = TaskModel::where('user_id', Auth::id())->get();
        return view('user.all-tasks.index', compact('tasks'));
    }
}
