<?php

namespace App\Http\Controllers\API\V1\Tasks;

use App\Http\Controllers\Controller;
use App\Http\Resources\API\V1\ProjectResource;
use App\Http\Resources\API\V1\StatuseResource;
use App\Http\Resources\API\V1\Tasks\TasksResource;
use App\Http\Resources\API\V1\TypeResource;
use App\Http\Resources\API\V1\UserResource;
use App\Models\Admin\ProjectModel;
use App\Models\Admin\StatusesModel;
use App\Models\Admin\TaskModel;
use App\Models\Admin\TaskTypeModel;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MonitoringController extends Controller
{
    public function index()
    {
        $tasks = TaskModel::where('status_id', '!=', 3)->get();

        return response([
           'message' => true,
           'tasks' => TasksResource::collection($tasks)
        ]);
    }

    public function filter_monitoring()
    {
        $projects = ProjectModel::all();
        $authors = User::role(['admin', 'client', 'team-lead'])->get();
        $types = TaskTypeModel::all();
        $statuses = StatusesModel::all();
        $users = User::role('user')->get();

        return response([
           'projects' => ProjectResource::collection($projects),
           'authors' => UserResource::collection($authors),
           'types' => TypeResource::collection($types),
           'statuses' => StatuseResource::collection($statuses),
           'users' => UserResource::collection($users)
        ]);

    }
}
