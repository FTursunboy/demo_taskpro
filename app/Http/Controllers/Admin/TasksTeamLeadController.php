<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseController;
use App\Http\Controllers\Controller;
use App\Models\Admin\TaskModel;
use App\Models\User;
use App\Models\User\CreateMyCommandTaskModel;
use App\Notifications\Telegram\SendNewTaskInUser;
use App\Notifications\Telegram\TelegramTeamLeadSendTaskInUser;
use App\Notifications\Telegram\TelegramTeamLeadTaskAccept;
use App\Notifications\Telegram\TelegramTeamLeadTaskDecline;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Notification;

class TasksTeamLeadController extends BaseController
{
    public function index()
    {
        $tasks = DB::table('task_models AS t')
            ->join('users AS u', 't.user_id', '=', 'u.id')
            ->join('project_models AS p', 't.project_id', '=', 'p.id')
            ->join('users AS author', 't.author_id', '=', 'author.id')
            ->whereIn('t.id', function ($query) {
                $query->select('cmc.task_id')
                    ->from('create_my_command_task_models AS cmc');
            })
            ->select('t.id AS task_id', 't.name AS task_name', 'p.name AS project', 'author.surname AS author_surname', 'author.name AS author_name', 'u.surname AS author_task_surname', 'u.name AS author_task_name', 't.slug AS task_slug')
            ->get();

        return view('admin.tasks-team-lead.index', compact('tasks'));
    }

    public function acceptTaskCommand($slug)
    {
        $task = TaskModel::withTrashed()
            ->where('slug', $slug)
            ->whereNotNull('deleted_at')
            ->first();
        $task->restore();
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
        return redirect()->route('admin.index')->with('create', 'Задача успешно создана!');
    }


    public function declineTaskCommand($slug)
    {
        $task = TaskModel::withTrashed()
            ->where('slug', $slug)
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
        return redirect()->route('admin.index')->with('delete', 'Задача успешно удалено!');
    }

    public function show($slug)
    {
        $task = TaskModel::withTrashed()
            ->where('slug', $slug)->first();
        return view('admin.tasks-team-lead.show', compact('task'));
    }
}
