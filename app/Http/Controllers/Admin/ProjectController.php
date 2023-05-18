<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\HistoryController;
use App\Http\Requests\Admin\ProjectRequest;
use App\Http\Requests\Admin\ProjectUpdateRequest;
use App\Models\Admin\ProjectModel;
use App\Models\Admin\ProjectTypeModel;
use App\Models\Admin\TaskTypeModel;
use App\Models\Statuses;
use App\Models\Types;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProjectController extends BaseController
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
        if ($request->file('file') !== null) {
            $file = $request->file('file')->store('public/project_docs');
        } else {
            $file = null;
        }
        $project =  ProjectModel::create($data);
        $project->update([
            'file' => $file ?? null,
            'file_name' => $request->file('file') ? $request->file('file')->getClientOriginalName() : null,
        ]);
        HistoryController::project($project->id, Statuses::CREATE);

        return redirect()->route('project.index')->with('create', 'Проект успешно создан!');
    }

    public function edit(ProjectModel $project)
    {
        $types = ProjectTypeModel::get();
        $types_project = Types::get();
        return view('admin.project.edit', compact('project', 'types', 'types_project'));
    }

    public function update(ProjectUpdateRequest $request, ProjectModel $projectModel)
    {
        $data = $request->validated();
        $projectModel->update($data);

        HistoryController::project($projectModel->id, Statuses::UPDATE);
        return redirect()->route('project.index')->with('update', 'Проект успешно изменен!');
    }

    public function destroy(ProjectModel $projectModel)
    {
        $projectModel->delete();

        HistoryController::project($projectModel->id, Statuses::DELETE);
        return back()->with('delete', 'Проект успешно удален!');
    }
}
