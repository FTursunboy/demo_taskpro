<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ProjectRequest;
use App\Http\Requests\Admin\ProjectUpdateRequest;
use App\Models\Admin\ProjectModel;
use App\Models\Admin\ProjectTypeModel;
use App\Models\Admin\TaskTypeModel;
use App\Models\Types;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index()
    {
        $projects = ProjectModel::get();



        return view('admin.project.index', compact('projects'));
    }

    public function show(ProjectModel $project)
    {
        return view('admin.project.show', compact('project'));
    }

    public function create()
    {
        $types = ProjectTypeModel::all();
        $typesOf = Types::all();
        return view('admin.project.create', compact('types', 'typesOf'));
    }

    public function store(ProjectRequest $request)
    {
        $data = $request->validated();



        ProjectModel::create($data);
        return redirect()->route('project.index')->with('create', 'Проект успешно содань');
    }

    public function edit(ProjectModel $project)
    {
        $types = TaskTypeModel::get();
        return view('admin.project.edit', compact('project', 'types'));
    }

    public function update(ProjectUpdateRequest $request, ProjectModel $projectModel)
    {
        $data = $request->validated();
        $projectModel->update($data);
        return redirect()->route('project.index')->with('update', 'Проект успешно изменен');
    }

    public function destroy(ProjectModel $projectModel)
    {
        $projectModel->delete();
        return back()->with('delete', 'Проект успешна удален!');
    }
}
