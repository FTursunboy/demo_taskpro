<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ClientRequest;
use App\Http\Requests\Admin\EmployeeRequest;
use App\Models\Admin\OtdelsModel;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Role;

class ClientController extends Controller
{
    public function index()
    {

        $users = User::role('client')->get();
        return view('admin.offers.clients.index', compact('users'));
    }

    public function create()
    {
        $roles = Role::where('name', '!=', 'admin')->get();
        $departs = OtdelsModel::get();
        return view('admin.offers.clients.index', compact('roles', 'departs'));
    }

    public function store(ClientRequest $request)
    {
        $data = $request->validated();
        User::create([
            'name' => $data['name'],
            'lastname' => $data['lastname'],
            'login' => $data['login'],
            'password' => Hash::make($data['password']),
            'phone' => $data['phone'],
            'telegram_user_id' => $data['name'],
            'slug' => Str::slug(Str::random(5) . ' ' . Str::random(5) . ' ' . Str::random(5), '-'),
        ])->assignRole('client');
        return redirect()->route('employee.index')->with('create', 'Клиент успешно создан');
    }

    public function show(User $user)
    {
        $tasks = $user->tasksSuccess($user->id);
        return view('admin.employee.show', compact('user', 'tasks'));
    }

    public function update()
    {

    }

    public function destroy()
    {
    }

}
