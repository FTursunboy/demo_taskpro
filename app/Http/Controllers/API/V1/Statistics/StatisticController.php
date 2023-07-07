<?php

namespace App\Http\Controllers\API\V1\Statistics;

use App\Http\Controllers\Controller;
use App\Http\Resources\API\V1\Statistics\ProjectTasksResource;
use App\Models\Admin\ProjectModel;
use Illuminate\Http\Request;

class StatisticController extends Controller
{
    public function projectStatic()
    {
        $projectTasksAdmin = ProjectModel::withCount('tasks')->orderByDesc('tasks_count')->get();

        $response = $projectTasksAdmin->map(function ($project) {
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
        });

        return response($response, 200);
    }

}
