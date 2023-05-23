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
use Illuminate\Support\Facades\Storage;
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
            'lastname' => $data['lastname'] ?? null,
            'login' => $data['login'],
            'password' => Hash::make($data['password']),
            'phone' => $data['phone'],
            'position' => $data['position'],
            'otdel_id' => $data['otdel_id'],
            'telegram_user_id' => $data['telegram_id'],
            'slug' => Str::slug(Str::random(5) . ' ' . Str::random(5) . ' ' . Str::random(5), '-'),
        ]);
        $user->assignRole('user');
        return redirect()->route('employee.index')->with('create', 'Сотрудник успешно создан!');
    }

    public function show($slug)
    {
        $user = User::where('slug', $slug)->firstOrFail();

        $project_tasks = TaskModel::where('user_id', '=', $user->id)->get();
        $tasks = $user->tasksSuccess($user->id);
        return view('admin.employee.show', compact('user', 'tasks', 'project_tasks'));
    }

    public function edit($slug)
    {
        $user = User::where('slug', $slug)->firstOrFail();

        $roles = Role::where('name', 'user')->get();
        $departs = OtdelsModel::get();
        return view('admin.employee.edit', compact('user', 'roles', 'departs'));
    }

    public function update($slug, UpdateEmployeeRequest $request)
    {
        $data = $request->validated();

        $employee = User::where('slug', $slug)->firstOrFail();

        if ($request->file('avatar') !== null) {
            if ($employee->avatar !== null) {
                Storage::disk('public')->delete($employee->avatar);
            }
            $file = Storage::disk('public')->put('/user_img', $request->file('avatar'));
        } else {
            $file = $employee->avatar;
        }

        $employee->update([
            'name' => $data['name'],
            'surname' => $data['surname'],
            'lastname' => $data['lastname'],
            'phone' => $data['phone'],
            'position' => $data['position'],
            'telegram_user_id' => $data['telegram_id'],
            'otdel_id' => $data['otdel_id'],
            'password' => Hash::make($data['password'] ?? 'password'),
            'avatar' => $file,
        ]);

        return redirect()->route('employee.index')->with('update', "Сотрудник успешно изменен!");
    }

    public function destroy($slug)
    {
        $employee = User::where('slug', $slug)->firstOrFail();
        $employee->delete();
        return redirect()->route('employee.index')->with('delete', "Сотрудник успешно удален!");
    }

}
