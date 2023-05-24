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
            return TaskModel::with(['author', 'project', 'user', 'client', 'status', 'type', 'typeType'])
                ->when($status !== '0', fn($query) => $query->where('status_id', $status))
                ->when($user !== '0', fn($query) => $query->where('user_id', $user))
                ->when($client !== '0', fn($query) => $query->where('client_id', $client))
                ->when($project !== '0', fn($query) => $query->where('project_id', $project))
                ->get();

        } catch (\Exception $exception) {
            return [
                'error' => $exception->getMessage(),
                'status' => false
            ];
        }

    }
}
