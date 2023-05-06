<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\ProjectTypeModel;
use Illuminate\Http\Request;

class ProjectTypeController extends Controller
{
    public function index()
    {

        $types = ProjectTypeModel::where('status', true)->get();

        return view('admin.projectType.index', compact('types'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required']
        ]);
        ProjectTypeModel::create([
            'name' => $data['name'],
            'status' => true,
        ]);
        return redirect()->route('settings.project')->with('mess', 'Успешно добавлен!!');

    }

    public function update(Request $request, ProjectTypeModel $projectTypeModel){
        $data = $request->validate([
            'name' => 'required',
        ]);

        $projectTypeModel->update([
            'name' => $data['name']
        ]);
        return redirect()->route('settings.project')->with('mess', 'Успешно обновлено');
    }
    public function delete(ProjectTypeModel $projectTypeModel) {

        $projectTypeModel->delete();
        return redirect()->route('settings.project')->with('mess', 'Успешно удалено');
    }
}
