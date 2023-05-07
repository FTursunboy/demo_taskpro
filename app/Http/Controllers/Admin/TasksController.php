<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\TasksRequest;
use App\Models\Admin\ProjectModel;
use App\Models\Admin\TaskModel;
use App\Models\Admin\TaskTypeModel;
use App\Models\Admin\TaskTypesTypeModel;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class TasksController extends Controller
{
    public function index()
    {
        $tasks = TaskModel::get();
        return view('admin.tasks.index', compact('tasks'));
    }

    public function create()
    {
        $types = TaskTypeModel::get();
        $projects = ProjectModel::get();
        $users = User::role('user');
        return view('admin.tasks.create', compact('types', 'projects', 'users'));
    }

    public function store(Request $request)
    {
        if ($request->file('file') !== null) {
            $file = $request->file('file')->store('public/docs');
        } else {
            $file = null;
        }
        TaskModel::create([
            'name' => $request->name,
            'time' => $request->time,
            'from' => $request->from,
            'to' => $request->to,
            'comment' => $request->comment ?? null,
            'file' => $file ?? null,
            'file_name' => $request->file('file') ? $request->file('file')->getClientOriginalName() : null,
            'project_id' => $request->project_id,
            'type_id' => $request->type_id,
            'kpi_id' => $request->kpi_id ?: null,
            'user_id' => $request->user_id,
            'author_id' => Auth::id(),
            'status_id' => 1,
            'client_id' => $request->client_id ?? null,
        ]);
        return redirect()->route('tasks.index')->with('create','Задача успешно создана');
    }


    public function kpi($id)
    {
        return TaskTypesTypeModel::where('typeTask_id', $id)->select('id', 'name')->get();
    }
}
