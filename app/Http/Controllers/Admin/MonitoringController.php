<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseController;
use App\Http\Controllers\Controller;
use App\Models\Admin\ProjectModel;
use App\Models\Admin\StatusesModel;
use App\Models\Admin\TaskModel;
use App\Models\User;
use Illuminate\Http\Request;

class MonitoringController extends BaseController
{
    public function index()
    {
        $tasks = TaskModel::get();
        $statuses = StatusesModel::get();
        $projects = ProjectModel::get();
        $users = User::role('user')->get();
        $clients = User::role('client')->get();
        return view('admin.monitoring.index', compact('tasks', 'statuses', 'projects', 'users', 'clients'));
    }

    public function filter($status, $user, $client, $project)
    {
        try {
            return $status === '0' && $user === '0' && $client === '0' && $project === '0'
                ? TaskModel::get()
                : TaskModel::query()
                    ->when($status !== '0', fn($query) => $query->where('status_id', $status))
                    ->when($user !== '0', fn($query) => $query->where('user_id', $user))
                    ->when($client !== '0', fn($query) => $query->where('client_id', $client))
                    ->when($project !== '0', fn($query) => $query->where('project_id', $project))
                    ->leftJoin('users as u', 'author_id', '=', 'u.id')
                    ->leftJoin('project_models as p', 'project_id', '=', 'p.id')
                    ->leftJoin('users as uid', 'user_id', '=', 'uid.id')
                    ->leftJoin('users as client', 'client_id', '=', 'client.id')
                    ->leftJoin('statuses_models as sts', 'status_id', '=', 'sts.id')
                    ->leftJoin('task_type_models as t', 'type_id', '=', 't.id')
                    ->select('task_models.*', 'u.name as author', 'u.surname as author_surname', 'p.name as project', 'uid.name as employee', 'uid.surname as employee_surname', 'client.name as client', 'client.surname as client_surname', 'sts.name as sts', 't.name as type')
                    ->groupBy('name')
                    ->get();
        } catch (\Exception $exception) {
            return [
                'error' => $exception->getMessage(),
                'status' => false
            ];
        }

    }
}
