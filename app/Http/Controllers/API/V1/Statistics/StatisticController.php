<?php

namespace App\Http\Controllers\API\V1\Statistics;

use App\Http\Controllers\Controller;
use App\Http\Resources\API\V1\Statistics\ProjectTasksResource;
use App\Models\Admin\ProjectModel;
use App\Models\Admin\TaskModel;
use App\Models\User;
use Illuminate\Http\Request;

class StatisticController extends Controller
{
    public function projectStatic()
    {
        $projectTasksAdmin = ProjectModel::withCount('tasks')->orderByDesc('tasks_count')->get();

        $response = [
            'ProjectTasks' => $projectTasksAdmin->map(function ($project) {
                return [
                    'name' => $project->name,
                    'count_tasks' => $project->tasks_count,
                    'count_ready' => $project->count_ready(),
                    'count_process' => $project->count_process(),
                    'count_verificateClient' => $project->count_verificateClient(),
                    'count_verificateAdmin' => $project->count_verificateAdmin(),
                    'count_outOfDate' => $project->count_outOfDate(),
                    'count_other' => $project->count_other(),
                ];
            }),
            'message' => true,
        ];

        return response($response, 200);
    }

    public function taskStatistic()
    {
        $taskStatistic = User::role('user')->withCount('taskUser')->get();

        $response = [
            'TaskModels' => $taskStatistic->map(function ($task){
                return [
                    'message' => true,
                    'name' => $task->name,
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
            })
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
            'statistics' => $arrs,
        ]);
    }



}
