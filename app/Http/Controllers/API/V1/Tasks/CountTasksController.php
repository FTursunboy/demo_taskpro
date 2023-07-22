<?php

namespace App\Http\Controllers\API\V1\Tasks;

use App\Http\Controllers\Controller;
use App\Models\Admin\TaskModel;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CountTasksController extends Controller
{
    public function panelAdmin()
    {
        return response([
           'message' => true,
           'all_tasks' => TaskModel::count(),
           'task_speed' => TaskModel::where('status_id', 7)->count(),
           'task_progress' => TaskModel::whereIn('status_id', [2, 4])->count(),
           'verificate_admin' => TaskModel::where('status_id', 6)->count(),
           'verificate_client' => TaskModel::where('status_id', 10)->count(),
           'reject_client' => TaskModel::where('status_id', 13)->count(),
           'archive' => TaskModel::where('status_id', 3)->count()
        ]);
    }

    public function panelUser()
    {
        $endDate = Carbon::now()->addDays(7)->format('Y-m-d');

        return response([
           'message' => true,
           'ready' => TaskModel::where([
               ['user_id', '=', Auth::id()],
               ['status_id', '=', 3]
           ])->count(),
           '7_days_left' => TaskModel::where([
               ['user_id', '=', Auth::id()],
               ['to', '<=', $endDate],
           ])
            ->whereIn('status_id', [2, 4])->count(),
           'speed' => TaskModel::where([
               ['user_id', '=', Auth::id()],
               ['status_id', '=', 7],
           ])->count(),
           'verificate_admin' => TaskModel::where([
               ['user_id', '=', Auth::id()],
               ['status_id', '=', 6]
           ])->count(),
            'in_progress' => TaskModel::where([
                ['user_id', '=', Auth::id()],
            ])->whereIn('status_id', [2, 4])->count(),
            'new' => TaskModel::where([
                ['user_id', '=', Auth::id()]
            ])->whereIn('status_id', [1, 9])->count(),
            'all' => TaskModel::where([
               ['user_id', '=', Auth::id()],
               ['status_id', '!=', 3]
           ])->count()
        ]);
    }
}
