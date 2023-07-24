<?php

namespace App\Http\Controllers\API\V1\Tasks;

use App\Http\Controllers\Controller;
use App\Http\Resources\API\V1\Tasks\TasksResource;
use App\Models\Admin\TaskModel;
use Illuminate\Http\Request;

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
}
