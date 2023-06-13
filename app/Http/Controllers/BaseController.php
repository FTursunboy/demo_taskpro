<?php

namespace App\Http\Controllers;

use App\Models\Admin\TaskModel;
use App\Models\ChatMessageModel;
use App\Models\Client\Offer;
use App\Models\ClientNotification;
use App\Models\Idea;
use App\Models\User;
use App\Models\User\CreateMyCommandTaskModel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class BaseController extends Controller
{
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $offers_count = Offer::where('user_id', null)->get()->count();
            $ideas_count = Idea::where('status_id', 1)->get()->count();

            $ready = TaskModel::where('status_id', 3)->get()->count();
            $all_tasks = TaskModel::get()->count();
            $out_of_date = TaskModel::where('status_id', 7)->count();
            $rejected = TaskModel::where('status_id', 5)->count();



            $notifications = ClientNotification::get();
            $newMessage = ChatMessageModel::where('user_id', Auth::id())->orwhere('offer_id', Auth::id())->orderBy('created_at','desc')->get();
            $command_task = CreateMyCommandTaskModel::get()->count();
            $usersTelegram = User::role('user')->get();
            view()->share([
                'notifications' => $notifications,
                'newMessage' => $newMessage,
                'offers_count' => $offers_count,
                'ideas_count' => $ideas_count,
                'ready' => $ready,
                'all_tasks' => $all_tasks,
                'out_of_date' => $out_of_date,
                'rejected' => $rejected,
                'command_task' => $command_task,
                'usersTelegram' => $usersTelegram,
                'tasksTeamLeads' => $this->taskTeamLead(),
            ]);
            return $next($request);

        });
    }

    public function taskTeamLead()
    {
        return DB::table('task_models AS t')
            ->join('users AS u', 't.user_id', '=', 'u.id')
            ->join('project_models AS p', 't.project_id', '=', 'p.id')
            ->join('users AS author', 't.author_id', '=', 'author.id')
            ->whereIn('t.id', function ($query) {
                $query->select('cmc.task_id')
                    ->from('create_my_command_task_models AS cmc');
            })
            ->select('t.id AS task_id', 't.name AS task_name', 'p.name AS project', 'author.surname AS author_surname', 'author.name AS author_name', 'u.surname AS author_task_surname', 'u.name AS author_task_name', 't.slug AS task_slug')
            ->get();
    }
}
