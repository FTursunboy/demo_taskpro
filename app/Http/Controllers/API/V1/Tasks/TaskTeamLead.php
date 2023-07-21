<?php

namespace App\Http\Controllers\API\V1\Tasks;

use App\Http\Controllers\Controller;
use App\Http\Controllers\HistoryController;
use App\Models\Admin\TaskModel;
use App\Models\Statuses;
use App\Models\User;
use App\Models\User\CreateMyCommandTaskModel;
use App\Notifications\Telegram\TelegramTeamLeadSendTaskInUser;
use App\Notifications\Telegram\TelegramTeamLeadTaskAccept;
use App\Notifications\Telegram\TelegramTeamLeadTaskDecline;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Notification;

class TaskTeamLead extends Controller
{
    public function taskTeamLead()
    {
        $taskTeamLead =  DB::table('task_models AS t')
            ->join('users AS u', 't.user_id', '=', 'u.id')
            ->join('project_models AS p', 't.project_id', '=', 'p.id')
            ->join('users AS author', 't.author_id', '=', 'author.id')
            ->join('task_type_models AS types', 't.type_id', '=', 'types.id')
            ->whereIn('t.id', function ($query) {
                $query->select('cmc.task_id')
                    ->from('create_my_command_task_models AS cmc');
            })
            ->select('t.id AS task_id', 't.name AS task_name', 't.time AS time', 't.from AS from', 't.to AS to', 't.comment AS comment', 'types.name AS type', 'p.name AS project',  'author.surname AS author_surname', 'author.name AS author_name', 'u.surname AS author_task_surname', 'u.name AS author_task_name', 't.slug AS task_slug')
            ->get();

        return response([
           'message' => true,
           'taskTeamLead' => $taskTeamLead
        ]);
    }

    public function show($id)
    {
        $task = TaskModel::withTrashed()
            ->where('id', $id)->first();

        return response([
           'message' => true,
           'taskTeamLead' => $task
        ]);
    }

    public function accept($id)
    {
        $task = TaskModel::withTrashed()
            ->where('id', $id)
            ->whereNotNull('deleted_at')
            ->first();
        $task->restore();
        HistoryController::task($task->id, $task->user_id, Statuses::CREATE);
        $my = CreateMyCommandTaskModel::where([
            ['task_id', $task->id],
            ['user_id', $task->user_id],
        ])->first();
        $my?->delete();
        try {
            Notification::send(User::find($task->author_id), new TelegramTeamLeadTaskAccept($task->name));
        } catch (\Exception $exception) {

        }
        try {
            $teamLead = User::find($task->author_id);
            Notification::send(User::find($task->user_id), new TelegramTeamLeadSendTaskInUser($task->id, $task->name, $task->time, $task->from, $task->to, $task->project->finish, $task->type->name, $teamLead->surname . ' ' . $teamLead->name));
        } catch (\Exception $exception) {

        }

        return response([
           'message' => true
        ]);
    }

    public function decline($id)
    {
        $task = TaskModel::withTrashed()
            ->where('id', $id)
            ->whereNotNull('deleted_at')
            ->first();
        $task?->forceDelete();
        $my = CreateMyCommandTaskModel::where([
            ['task_id', $task->id],
            ['user_id', $task->user_id],
        ])->first();
        $my?->delete();
        try {
            Notification::send(User::find($task->author_id), new TelegramTeamLeadTaskDecline($task->name));
        } catch (\Exception $exception) {

        }

        return response([
           'message' => true
        ]);
    }
}
