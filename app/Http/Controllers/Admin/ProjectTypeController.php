<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseController;
use App\Http\Controllers\Controller;
use App\Models\Admin\ProjectTypeModel;
use Illuminate\Http\Request;

class ProjectTypeController extends BaseController
{
    public function index()
    {

        $types = ProjectTypeModel::get();

        return view('admin.settings.index', compact('types'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required']
        ]);
        ProjectTypeModel::create([
            'name' => $data['name'],
        ]);
        return redirect()->route('settings.project')->with('create', 'Успешно добавлен!');

    }

    public function update(Request $request, ProjectTypeModel $projectTypeModel){
        $data = $request->validate([
            'name' => 'required',
        ]);
        $projectTypeModel->update([
            'name' => $data['name']
        ]);
        return redirect()->route('settings.project')->with('update', 'Успешно обновлено!');
    }
    public function delete(ProjectTypeModel $projectTypeModel) {
        $projectTypeModel->delete();
        return redirect()->route('settings.project')->with('delete', 'Успешно удалено!');
    }
}
