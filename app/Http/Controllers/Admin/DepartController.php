<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseController;
use App\Http\Controllers\Controller;
use App\Models\Admin\OtdelsModel;
use Illuminate\Http\Request;

class DepartController extends BaseController
{
    public function index()
    {
        $otdels = OtdelsModel::get();
        return view('admin.settings.otdel', compact('otdels'));
    }

    public function store(Request $request)
    {
        $date = $request->validate([
            'name' => ['required', 'unique:otdels_models,name']
        ]);
        OtdelsModel::create([
            'name' => $date['name']
        ]);
        return redirect()->route('settings.depart')->with('create', 'Отдел успешно создан!');
    }

    public function update(OtdelsModel $depart, Request $request)
    {
        $data = $request->validate(['name' => 'required']);
        $depart->update([
            'name' => $data['name']
        ]);
        return redirect()->route('settings.depart')->with('update', 'Отдел успешно обновлен!');
    }

    public function destroy(OtdelsModel $depart)
    {
        $depart->delete();
        return redirect()->route('settings.depart')->with('delete', 'Отдел успешно удален!');
    }
}
