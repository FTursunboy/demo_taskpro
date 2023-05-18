<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseController;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\EmployeeRequest;
use App\Http\Requests\Admin\UpdateEmployeeRequest;
use App\Models\Admin\OtdelsModel;
use App\Models\Admin\ProjectModel;
use App\Models\Admin\TaskModel;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Role;

class EmployeeController extends BaseController
{
    public function index()
    {
        $users = User::role('user')->get();
        return view('admin.employee.index', compact('users'));
    }

    public function create()
    {
        $roles = Role::where('name', 'user')->get();
        $departs = OtdelsModel::get();
        return view('admin.employee.create', compact('roles', 'departs'));
    }

    public function store(EmployeeRequest $request)
    {
        $data = $request->validated();
        $user = User::create([
            'name' => $data['name'],
            'surname' => $data['surname'],
            'lastname' => $data['lastname'],
            'login' => $data['login'],
            'password' => Hash::make($data['password']),
            'phone' => $data['phone'],
            'position' => $data['position'],
            'otdel_id' => $data['otdel_id'],
            'telegram_user_id' => $data['name'],
            'slug' => Str::slug(Str::random(5) . ' ' . Str::random(5) . ' ' . Str::random(5), '-'),
        ]);
        $user->assignRole('user');
        return redirect()->route('employee.index')->with('create', 'Сотрудник успешно создан!');
    }

    public function show(User $user)
    {
        $project_tasks = TaskModel::where('user_id', '=', $user->id)->get();
        $tasks = $user->tasksSuccess($user->id);
        return view('admin.employee.show', compact('user', 'tasks', 'project_tasks'));
    }

    public function edit(User $user)
    {
        $roles = Role::where('name', 'user')->get();
        $departs = OtdelsModel::get();
        return view('admin.employee.edit', compact('user', 'roles', 'departs'));
    }

    public function update(User $employee, UpdateEmployeeRequest $request)
    {
        $data = $request->validated();
        $employee->update([
            'name' => $data['name'],
            'surname' => $data['surname'],
            'lastname' => $data['lastname'],
            'phone' => $data['phone'],
            'position' => $data['position'],
            'otdel_id' => $data['otdel_id'],
            'password' => Hash::make($data['password'] ?? 'password'),
        ]);
        return redirect()->route('employee.index')->with('update', "Сотрудник успешно изменен!");
    }

    public function destroy(User $employee)
    {
        $employee->delete();
        return redirect()->route('employee.index')->with('delete', "Сотрудник успешно удален!");
    }

}
