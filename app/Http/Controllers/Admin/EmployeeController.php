<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\EmployeeRequest;
use App\Models\Admin\OtdelsModel;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Role;

class EmployeeController extends Controller
{
    public function index()
    {
        $users = User::where('login', '!=', 'admin')->get();
        return view('admin.employee.index', compact('users'));
    }

    public function create()
    {
        $roles = Role::where('name', '!=', 'admin')->get();
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
        $user->assignRole(Role::where('id', $data['role'])->first()->name);
        return redirect()->route('employee.index')->with('create', 'Сотрудник успешно создан');
    }

    public function show()
    {

    }

    public function update()
    {

    }

    public function destroy()
    {
    }
}
