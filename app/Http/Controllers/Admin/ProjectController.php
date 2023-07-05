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
use Illuminate\Support\Facades\Storage;

class ProjectController extends BaseController
{
    public function index()
    {
        $projects = ProjectModel::where('pro_status', '!=',3)->get();

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
        $file = $projectModel->file;

        if ($request->hasFile('file')) {
            $newFile = $request->file('file')->store('public/project_docs/');
            if ($newFile !== $file) {
                if ($file !== null) {
                    Storage::delete($file);
                }
                $file = $newFile;
            }
        }



//        $data = $request->validated();

        $projectModel->update([
            'name' => $request['name'],
            'file' => $file ?? null,
            'file_name' => $request->file('file') ? $request->file('file')->getClientOriginalName() : null,
            'type_id' => $request['type_id'],
            'time' => $request['time'],
            'start' => $request['start'],
            'finish' => $request['finish'],
            'comment' => $request['comment'],
            'types_id' => $request['types_id'],
        ]);

        HistoryController::project($projectModel->id, Statuses::UPDATE);
        return redirect()->route('project.index')->with('create', 'Проект успешно изменен!');
    }

    public function destroy(ProjectModel $projectModel)
    {
        $projectModel->delete();

        HistoryController::project($projectModel->id, Statuses::DELETE);
        return back()->with('create', 'Проект успешно удален!');
    }

    public function downloadFile(ProjectModel $project)
    {


        $path = storage_path('app/' . $project->file);

        $headers = [
            'Content-Type' => 'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
            'Content-Disposition' => 'attachment; filename="' . $project->file_name . '"',
        ];
        return response()->download($path, $project->file_name, $headers);

    }


    public function close(ProjectModel $project)
    {
        $project->pro_status = 3;
        $project->save();
        return redirect()->route('project.index')->with('create', 'Проект успешно закрылось');
    }
    public function de_active(ProjectModel $project) {
       $project->is_active = false;
       $project->save();

       return redirect()->back()->with('mess', 'Успешно деактивировано');
    }
    public function active(ProjectModel $project) {
        $project->is_active = true;
        $project->save();

        return redirect()->back()->with('mess', 'Успешно активировано');
    }

}
