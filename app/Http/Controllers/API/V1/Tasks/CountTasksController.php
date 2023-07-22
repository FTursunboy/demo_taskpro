<?php

namespace App\Http\Controllers\API\V1\Tasks;

use App\Http\Controllers\Controller;
use App\Models\Admin\TaskModel;
use Illuminate\Http\Request;

class CountTasksController extends Controller
{
    public function panelAdmin()
    {
        return response([
           'all_tasks' => TaskModel::count(),
           'task_speed' => TaskModel::where('status_id', 7)->count(),
           'task_progress' => TaskModel::whereIn('status_id', [2, 4])->count(),
           'verificate_admin' => TaskModel::where('status_id', 6)->count(),
           'verificate_client' => TaskModel::where('status_id', 10)->count(),
           'reject_client' => TaskModel::where('status_id', 13)->count(),
           'archive' => TaskModel::where('status_id', 3)->count()
        ]);
    }
}
