<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ClientRequest;
use App\Http\Requests\Admin\EmployeeRequest;
use App\Http\Requests\Admin\UpdateClientRequest;
use App\Models\Admin\OtdelsModel;
use App\Models\Admin\ProjectModel;
use App\Models\ProjectClient;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Role;

class ClientController extends Controller
{
    public function index()
    {
        $users = User::role('client')->get();
        $projects = ProjectModel::where('types_id', 2)->get();
        return view('admin.offers.clients.index', compact('users', 'projects'));
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
        $user = User::create([
            'name' => $data['name'],
            'lastname' => $data['lastname'],
            'login' => $data['login'],
            'password' => Hash::make($data['password']),
            'phone' => $data['phone'],
            'telegram_user_id' => $data['name'],
            'slug' => Str::slug(Str::random(5) . ' ' . Str::random(5) . ' ' . Str::random(5), '-'),
        ])->assignRole('client');

        ProjectClient::create([
            'user_id' => $user->id,
            'project_id' => $data['project_id']
        ]);

        return redirect()->route('employee.client')->with('create', 'Клиент успешно создан');
    }

    public function show(User $user)
    {
        $tasks = $user->tasksSuccess($user->id);
        return view('admin.offers.clients.show', compact('user', 'tasks'));
    }

    public function edit(User $user)
    {
        $roles = Role::where('name', 'client')->get();
        $projects = ProjectModel::where('types_id', 2)->get();
        $project_id = ProjectClient::where('user_id', $user->id)->first();
        return view('admin.offers.clients.edit', compact('user', 'roles', 'projects', 'project_id'));
    }

    public function update(User $user, UpdateClientRequest $request)
    {
        $data = $request->validated();
        $user->update([
            'name' => $data['name'],
            'lastname' => $data['lastname'],
            'surname' => $data['surname'],
            'password' => Hash::make($data['password'] ?? 'password'),
            'phone' => $data['phone'],
            'telegram_user_id' => $data['telegram_id'],
        ]);

        ProjectClient::where('user_id', $user->id)->first()->update([
            'project_id' => $data['project_id']
        ]);

        return redirect()->route('employee.client')->with('update', 'Клиент успешно изменён');
    }

    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('employee.client')->with('delete', 'Клиент успешно удален');
    }

}
