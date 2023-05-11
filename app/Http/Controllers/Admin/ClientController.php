<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ClientRequest;
use App\Http\Requests\Admin\EmployeeRequest;
use App\Models\Admin\OtdelsModel;
use App\Models\Admin\ProjectModel;
use App\Models\ProjectClient;
use App\Models\ProjectUser;
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
        return view('admin.employee.show', compact('user', 'tasks'));
    }

    public function update()
    {

    }

    public function destroy()
    {
    }

}
