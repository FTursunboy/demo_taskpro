<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Admin\TaskTypeModel;
use App\Models\Admin\TaskTypesTypeModel;
use App\Models\Types;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MyCommandController extends Controller
{
    public function index()
    {
        $commands = new User\TeamLeadCommandModel();
        $myCommand = $commands->userInCommand(Auth::id());
        $myProject = $commands->commandProjects(Auth::id());
        $userListTasks = $commands->userTaskList(Auth::id());
        $types = TaskTypeModel::get();
        return view('user.my-command.index', compact('myCommand', 'myProject', 'types', 'userListTasks'));
    }
}
