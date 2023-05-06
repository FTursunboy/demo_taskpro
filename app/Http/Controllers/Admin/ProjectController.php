<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ProjectRequest;
use App\Models\Admin\ProjectModel;
use App\Models\Admin\ProjectTypeModel;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index()
    {
        $projects = ProjectModel::where('status', true)->get();
        return view('admin.project.index', compact('projects'));
    }

    public function create()
    {
        $types = ProjectTypeModel::all();
        return view('admin.project.create', compact('types'));
    }

    public function store(ProjectRequest $request)
    {
        $data = $request->validated();
        dd($data);
    }
}
