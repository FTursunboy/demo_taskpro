<?php

namespace App\Http\Controllers\API\V1\Statistics;

use App\Http\Controllers\Controller;
use App\Http\Resources\API\V1\Statistics\ProjectTasksResource;
use App\Models\Admin\ProjectModel;
use App\Models\Admin\TaskModel;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StatisticController extends Controller
{
    public function projectStatic()
    {
//        $projectTasksAdmin = ProjectModel::withCount('tasks')->orderByDesc('tasks_count')->get();
        return response()->json([
            'ProjectTasks' => DB::table('project_models as p')
                ->leftJoin('task_models as t', 'p.id', '=', 't.project_id')
                ->where('t.deleted_at', '=', null)
                ->select('p.name as name', 'p.id as id',
                    DB::raw('COUNT(t.*) as count_task'),
                    DB::raw('COUNT(CASE WHEN t.status_id = 3 THEN 1 ELSE NULL END) as count_ready'),
                    DB::raw('COUNT(CASE WHEN t.status_id = 2 OR t.status_id = 4 THEN 1 ELSE NULL END) as count_process'),
                    DB::raw('COUNT(CASE WHEN t.status_id = 10 THEN 1 ELSE NULL END) as count_verificateClient'),
                    DB::raw('COUNT(CASE WHEN t.status_id = 6 OR t.status_id = 14 THEN 1 ELSE NULL END) as count_verificateAdmin'),
                    DB::raw('COUNT(CASE WHEN t.status_id = 7 THEN 1 ELSE NULL END) as count_outOfDate'),
                    DB::raw('COUNT(CASE WHEN t.status_id = 1 OR t.status_id = 5 OR t.status_id = 8 OR t.status_id = 9
                               OR t.status_id = 11 OR t.status_id = 12 OR t.status_id = 13 THEN 1 ELSE NULL END) as count_other')
                )
                ->groupBy('p.name', 'p.id')
                ->get(),
            'message' => true,
        ]);
//        $response = [
//            'ProjectTasks' => $projectTasksAdmin->map(function ($project) {
//                return [
//                    'name' => $project->name,
//                    'count_tasks' => $project->tasks_count,
//                    'count_ready' => $project->count_ready(),
//                    'count_process' => $project->count_process(),
//                    'count_verificateClient' => $project->count_verificateClient(),
//                    'count_verificateAdmin' => $project->count_verificateAdmin(),
//                    'count_outOfDate' => $project->count_outOfDate(),
//                    'count_other' => $project->count_other(),
//                ];
//            }),
//            'message' => true,
//        ];

//        return response($response, 200);
    }

    public function taskStatistic()
    {
        $taskStatistic = User::role('user')->withCount('taskUser')->get();

        $response = [
            'message' => true,
            'statistics' => $taskStatistic->map(function ($task) {
                return [
                    'name' => $task->name . " " . $task->surname,
                    'all_tasks' => $task->taskCount($task->id),
                    'debt_tasks' => $task->debt_tasks($task->id),
                    'taskProgress' => $task->taskProgress($task->id),
                    'taskReady' => $task->taskReady($task->id),
                    'out_of_date' => $task->out_of_date($task->id),
                    'expected_user' => $task->expected_user($task->id),
                    'verificateAdmin' => $task->verificateAdmin($task->id),
                    'verificateClient' => $task->verificateClient($task->id),
                    'rejectAdmin' => $task->rejectAdmin($task->id),
                    'rejectClient' => $task->rejectClient($task->id),

                ];
            }),
        ];

        return response($response, 200);
    }

    public function filter($month)
    {
        return $this->getFilter($month);
    }

    public function getFilter($month)
    {
        $arrs = [];
        $users = User::role('user')->get();
        foreach ($users as $user) {
            $arrs[] = [
                'name' => $user->name . " " . $user->surname,
                'all_tasks' => $user->getUserTasksInMonth($month, $user->id)['total'],
                'debt_tasks' => $user->debt($month, $user->id),
                'taskProgress' => $user->getUserTasksInMonth($month, $user->id)['process'],
                'taskReady' => $user->getUserTasksInMonth($month, $user->id)['ready'],
                'out_of_date' => $user->getUserTasksInMonth($month, $user->id)['speed'],
                'expected_user' => $user->getUserTasksInMonth($month, $user->id)['expectedUser'],
                'verificateAdmin' => $user->getUserTasksInMonth($month, $user->id)['forVerificationAdmin'],
                'verificateClient' => $user->getUserTasksInMonth($month, $user->id)['forVerificationClient'],
                'rejectAdmin' => $user->getUserTasksInMonth($month, $user->id)['rejectedAdmin'],
                'rejectClient' => $user->getUserTasksInMonth($month, $user->id)['rejectedClient'],
            ];
        }
//dd($arrs);

        return response([
            'message' => true,
            'statistics' => $arrs,
        ]);
    }


}
