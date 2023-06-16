<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Admin\IndexController;
use App\Models\Admin\ProjectModel;
use App\Models\Admin\TaskModel;
use App\Models\ChatMessageModel;
use App\Models\Client\Offer;
use App\Models\ClientNotification;
use App\Models\Idea;
use App\Models\SystemIdea;
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


            $tasksOfDashboard = ProjectModel::withCount('tasks')->orderByDesc('tasks_count')->get();



            $notifications = ClientNotification::get();
            $newMessage = ChatMessageModel::where('user_id', Auth::id())->orwhere('offer_id', Auth::id())->orderBy('created_at','desc')->get();
            $command_task = CreateMyCommandTaskModel::get()->count();
            $usersTelegram = User::role('user')->get();



            $ideasOfDashboard = Idea::get();
            $ideasOfDashboardUser = Idea::where('user_id', Auth::id())->get();
            $systemIdeasOfDashboard = SystemIdea::get();
            $systemIdeasOfDashboardUser = SystemIdea::where('user_id', Auth::id())->get();

            $birthday = new IndexController();
            $birthdayUsers = $birthday->birthday();

            $system_idea_count = SystemIdea::where('status_id', 1)->count();


            $systemIdeasOfDashboardClient = SystemIdea::where('user_id', Auth::id())->get();

            $notes = Auth::user()->notesList(Auth::id());
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
                'tasksOfDashboard' => $tasksOfDashboard,
                'ideasOfDashboard' => $ideasOfDashboard,
                'ideasOfDashboardUser' => $ideasOfDashboardUser,
                'systemIdeasOfDashboard' => $systemIdeasOfDashboard,
                'systemIdeasOfDashboardUser' => $systemIdeasOfDashboardUser,
                'birthdayUsers' => $birthdayUsers,
                'systemIdeasOfDashboardClient' => $systemIdeasOfDashboardClient,

                'notes' => $notes,

                'system_idea_count' => $system_idea_count

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
            ->join('task_type_models AS types', 't.type_id', '=', 'types.id')
            ->whereIn('t.id', function ($query) {
                $query->select('cmc.task_id')
                    ->from('create_my_command_task_models AS cmc');
            })
            ->select('t.id AS task_id', 't.name AS task_name', 't.time AS time', 't.from AS from', 't.to AS to', 't.comment AS comment', 'types.name AS type', 'p.name AS project',  'author.surname AS author_surname', 'author.name AS author_name', 'u.surname AS author_task_surname', 'u.name AS author_task_name', 't.slug AS task_slug')
            ->get();
    }


}
