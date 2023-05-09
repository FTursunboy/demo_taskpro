<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\ProjectModel;
use App\Models\Admin\StatusesModel;
use App\Models\Admin\TaskModel;
use App\Models\User;
use Illuminate\Http\Request;

class MonitoringController extends Controller
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

    public function status($status, $user, $client, $project)
    {
        try {
            if ($status !== '0' && $user === '0' && $client === '0' && $project === '0') {
                return TaskModel::where('status_id', $status)->get();
            } elseif ($status === '0' && $user !== '0' && $client === '0' && $project === '0') {
                return TaskModel::where('user_id', $user)->get();
            } elseif ($status === '0' && $user === '0' && $client !== '0' && $project === '0') {
                return TaskModel::where('client_id', $client)->get();
            } elseif ($status === '0' && $user === '0' && $client === '0' && $project !== '0') {
                return TaskModel::where('project_id', $project)->get();
            }
            if ($status !== '0' && $user !== '0' && $client === '0' && $project === '0') {
                return TaskModel::where([
                    ['status_id', $status],
                    ['user_id', $user],
                ])->get();
            } elseif ($status !== '0' && $user !== '0' && $client !== '0' && $project === '0') {
                return TaskModel::where([
                    ['status_id', $status],
                    ['user_id', $user],
                    ['client_id', $client],
                ])->get();
            } elseif ($status !== '0' && $user !== '0' && $client !== '0' && $project !== '0') {
                return TaskModel::where([
                    ['status_id', $status],
                    ['user_id', $user],
                    ['client_id', $client],
                    ['project_id', $project],
                ])->get();
            }
            if ($project !== '0' && $status !== '0' && $user === '0' && $client === '0') {
                return TaskModel::where([
                    ['project_id', $project],
                    ['status_id', $status],
                ])->get();
            } elseif ($project === '0' && $status !== '0' && $user === '0' && $client !== '0') {
                return TaskModel::where([
                    ['client_id', $client],
                    ['status_id', $status],
                ])->get();
            } elseif ($project !== '0' && $status !== '0' && $user !== '0' && $client == '0') {
                return TaskModel::where([
                    ['user_id', $user],
                    ['project_id', $project],
                    ['status_id', $status],
                ])->get();
            } elseif ($project !== '0' && $status === '0' && $user !== '0' && $client == '0') {
                return TaskModel::where([
                    ['user_id', $user],
                    ['project_id', $project],
                ])->get();
            }
            return [
                $status, $user, $client, $project
            ];
        } catch (\Exception $exception) {
            return $exception->getMessage();
        }

    }
}
