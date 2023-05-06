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
        return redirect()->back()->with('mess', 'Операция прошло успешно!');
    }

    public function update(Request $request, TaskTypeModel $taskTypeModel)
    {
        $data = $request->validate([
            'name' => ['required'],
        ]);

        $taskTypeModel->update([
            'name' => $data['name']
        ]);
        return redirect()->back()->with('mess', 'Операция прошло успешно!');
    }


    public function kpi(TaskTypeModel $taskTypeModel)
    {
        $types = TaskTypesTypeModel::where('typeTask_id', $taskTypeModel)->get();

        return view('superAdmin.tasks.kpi.kpi', compact('taskTypeModel', 'kpi'));
    }

    public function kpiStore(Request $request)
    {
        $data = $request->validate([
            'name' => ['required'],
            'typeTask' => ['required', 'exists:task_setting_models,id'],
        ]);

        try {
            TaskTypesTypeModel::create([
                'name' => $data['name'],
                'typeTask_id' => $data['typeTask'],
            ]);
            return redirect()->route('settings.kpi')->with('mess', 'Операция прошло успешно!');
        } catch (\Exception $exception) {
            return redirect()->route('settings.kpi')->with('err', $exception->getMessage());
        }
    }

    public function kpiDelete(TaskTypesTypeModel $taskTypesTypeModel)
    {
        $taskTypesTypeModel->delete();
        return redirect()->back()->with('mess', 'Успешно обновлено');
    }


    public function kpi_update(Request $request, TaskTypesTypeModel $taskTypesTypeModel)
    {
        $data = $request->validate([
            'name' => 'required'
        ]);
        $taskTypesTypeModel->update([
            'name' => $data['name']
        ]);
        return redirect()->route('settings.kpi', $taskTypesTypeModel->typeTask_id)->with('mess', 'Успешно обновлено');
    }

    public function delete(TaskTypeModel $taskTypeModel)
    {
        $taskTypeModel->delete();
        return redirect()->back()->with('mess', 'Успешно удалено');
    }
}
