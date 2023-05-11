<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\TaskModel;
use App\Models\Admin\TaskTypeModel;
use App\Models\Admin\TaskTypesTypeModel;
use Illuminate\Http\Request;

class TaskTypeController extends Controller
{

    public function index()
    {
        $types = TaskTypeModel::get();
        return view('admin.settings.task', compact('types'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required']
        ]);
        TaskTypeModel::create([
            'name' => $data['name'],
        ]);
        return redirect()->back()->with('create', 'Операция прошло успешно!');
    }

    public function update(Request $request, TaskTypeModel $taskTypeModel)
    {
        $data = $request->validate([
            'name' => ['required'],
        ]);

        $taskTypeModel->update([
            'name' => $data['name']
        ]);
        return redirect()->back()->with('update', 'Операция прошло успешно!');
    }


    public function kpi(TaskTypeModel $taskTypeModel)
    {

        $types = TaskTypesTypeModel::where('typeTask_id', $taskTypeModel->id)->get();

        $taskType = TaskTypeModel::get();

        return view('admin.settings.kpi', compact('taskTypeModel', 'types', 'taskType'));
    }

    public function kpiStore(Request $request)
    {

        $data = $request->validate([
            'name' => ['required'],
            'typetask' => ['required'],
        ]);
        try {

            TaskTypesTypeModel::create([
                'name' => $data['name'],
                'typeTask_id' => $data['typetask'],
            ]);
            return redirect()->route('settings.kpi')->with('create', 'Операция прошло успешно!');
        } catch (\Exception $exception) {
            return redirect()->route('settings.kpi', 1)->with('error', $exception->getMessage());
        }
    }

    public function kpiDelete(TaskTypesTypeModel $taskTypesTypeModel)
    {
        $taskTypesTypeModel->delete();
        return redirect()->back()->with('delete', 'Успешно обновлено');
    }


    public function kpi_update(Request $request, TaskTypesTypeModel $taskTypesTypeModel)
    {
        $data = $request->validate([
            'name' => 'required'
        ]);
        $taskTypesTypeModel->update([
            'name' => $data['name']
        ]);
        return redirect()->route('settings.kpi', $taskTypesTypeModel->typeTask_id)->with('create', 'Успешно обновлено');
    }

    public function delete(TaskTypeModel $taskTypeModel)
    {
        $taskTypeModel->delete();
        return redirect()->back()->with('delete', 'Успешно удалено');
    }
}
