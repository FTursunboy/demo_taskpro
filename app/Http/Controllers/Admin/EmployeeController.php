<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseController;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\EmployeeRequest;
use App\Http\Requests\Admin\UpdateEmployeeRequest;
use App\Models\Admin\OtdelsModel;
use App\Models\Admin\ProjectModel;
use App\Models\Admin\TaskModel;
use App\Models\ClientMail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
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


        // for team-lead command
        $roles = Role::where('name', '=', 'team-lead')->get();
        $projects = ProjectModel::where('pro_status', '!=', 3)->get();
        $users = User::role(['user'])->where('slug', '!=', $slug)->get();
        $userCommand = new User\TeamLeadCommandModel();
        return view('admin.employee.show', compact('user', 'tasks', 'project_tasks', 'roles', 'projects', 'users', 'userCommand'));
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
            'login' => $data['login'],
            'phone' => $data['phone'],
            'position' => $data['position'],
            'telegram_user_id' => $data['telegram_id'],
            'otdel_id' => $data['otdel_id'],
            'password' => Hash::make($data['password'] ?? 'password'),
            'avatar' => $file,
        ]);

        $user = User::where('slug', $slug)->firstOrFail();

        $clientMail = ClientMail::where('user_id', $user->id)->first();
        if ($clientMail) {
            $clientMail->update([
                'email' => $data['client_email'],
            ]);
        } else {
            ClientMail::create([
                'user_id' => $user->id,
                'email' => $data['client_email'],
            ]);
        }

        return redirect()->route('employee.index')->with('update', "Сотрудник успешно изменен!");
    }

    public function addRole($slug, Request $request)
    {
        $user = User::where('slug', $slug)->first();
        $role = Role::where('id', $request->role)->first();
        $user->assignRole($role);
        return redirect()->route('employee.index')->with('update', 'Роль добавлен!');
    }

    public function destroy($slug)
    {
        $employee = User::where('slug', $slug)->firstOrFail();
        $employee->delete();
        return redirect()->route('employee.index')->with('delete', "Сотрудник успешно удален!");
    }



    // for team-lead command function
    public function makeTeamLead(Request $request, User $employee)
    {
        $data = $request->validate([
            'role' => ['required', 'exists:roles,id'],
            'project' => ['required', 'exists:project_models,id'],
            'users' => ['required']
        ]);

        $my = User\TeamLeadCommandModel::where([
            ['user_id', '=', $employee->id],
            ['project_id', '=', $data['project']],
            ['teamLead_id', '=', $employee->id]
        ])->first();

        if ($my === null) {
            User\TeamLeadCommandModel::create([
                'user_id' => $employee->id,
                'project_id' => $data['project'],
                'teamLead_id' => $employee->id
            ]);
        } else {
            return redirect()->route('employee.show', $employee->slug)->with('update', "Такая группа уже есть.");
        }

        foreach ($data['users'] as $u) {
            User\TeamLeadCommandModel::create([
                'user_id' => $u,
                'project_id' => $data['project'],
                'teamLead_id' => $employee->id
            ]);
        }
        $role = Role::where('id', $data['role'])->first();
        $employee->assignRole($role->name);
        $project = ProjectModel::where('id', $data['project'])->first()->name;
        return redirect()->route('employee.show', $employee->slug)->with('create', "Сотрудник успешно стал тимлидом проекта '$project'. ");
    }

    public function deleteFromCommand(ProjectModel $project, User $teamLead)
    {
        $my = User\TeamLeadCommandModel::where([
            ['user_id', '=', $teamLead->id],
            ['project_id', '=', $project->id],
            ['teamLead_id', '=', $teamLead->id]
        ])->first();
        $my?->delete();
        $command = User\TeamLeadCommandModel::where([
            ['teamLead_id', $teamLead->id],
            ['project_id', $project->id],
        ])->get();
        foreach ($command as $value) {
            $commandModel = User\TeamLeadCommandModel::where([
                ['teamLead_id', $teamLead->id],
                ['project_id', $project->id],
                ['id', $value->id]
            ])->first();
            $commandModel?->delete();
        }
        return redirect()->route('employee.show', $teamLead->slug)->with('delete', "Группа успешна удалено");
    }

    public function deleteAllCommand(User $employee)
    {
        $command = User\TeamLeadCommandModel::where([
            ['teamLead_id', $employee->id]
        ])->get();
        foreach ($command as $user) {
            $user?->delete();
        }
        $employee->removeRole('team-lead');
        return redirect()->route('employee.show', $employee->slug)->with('delete', "Успешно удалено");
    }

    public function showCommand(User $user, ProjectModel $project)
    {
        $users = User::role('user')->get();
        $userCommand = new User\TeamLeadCommandModel();
        $commands = $userCommand->myCommand($user->id, $project->id);
        return view('admin.employee.command.command_show', compact('user', 'users', 'commands', 'project'));
    }

    public function addUserInCommand(User $teamLead, ProjectModel $project, Request $request)
    {
        $data = $request->validate(['users' => ['required']]);;
        foreach ($data['users'] as $u) {
            User\TeamLeadCommandModel::create([
                'user_id' => $u,
                'project_id' => $project->id,
                'teamLead_id' => $teamLead->id
            ]);
        }
        return redirect()->route('employee.command-show', [$teamLead->id, $project->id])->with('create', "$teamLead->surname $teamLead->name $teamLead->lastname успешно добавлено в группу.");
    }

    public function deleteUserInGroup(User $teamLead, ProjectModel $project, User $user)
    {
        $info = User\TeamLeadCommandModel::where([
            ['user_id', $user->id],
            ['project_id', $project->id],
            ['teamLead_id', $teamLead->id]
        ])->first();
        $info?->delete();
        return redirect()->route('employee.command-show', [$teamLead->id, $project->id])->with('delete', "$user->surname $user->name $user->lastname успешна удалено из группы.");
    }



    // fro role to CRM functions
    public function roleToCRM(User $employee)
    {
        $employee->assignRole('crm');
        return redirect()->route('employee.show', $employee->slug)->with('create', "Теперь у $employee->surname $employee->name $employee->lastname есть доступ к CRM");
    }

    public function removeRoleToCRM(User $employee)
    {
        $employee->removeRole('crm');
        return redirect()->route('employee.show', $employee->slug)->with('delete', "Теперь у $employee->surname $employee->name $employee->lastname нет доступ к CRM");

    }

}
