<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Admin\IndexController;
use App\Models\Admin\CRM\Lead;
use App\Models\Admin\CRM\LeadStatus;
use App\Models\Admin\ProjectModel;
use App\Models\Admin\TaskModel;
use App\Models\Admin\TasksClient;
use App\Models\Admin\TaskTypeModel;
use App\Models\Admin\TaskTypesTypeModel;
use App\Models\ChatMessageModel;
use App\Models\Client\Offer;
use App\Models\ClientNotification;
use App\Models\Idea;
use App\Models\Setting;
use App\Models\SystemIdea;
use App\Models\User;
use App\Models\User\CreateMyCommandTaskModel;
use App\Models\User\MyPlanModel;
use App\Models\Users\NotesModels;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class BaseController extends Controller
{
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $offers_count = cache()->remember('offers_count', 300, function () {
                return Offer::where([
                    ['user_id', null],
                    ['status_id', '!=', 11]
                ])->count();
            });

            $statistics = cache()->remember('user_statistics', 300, function () {
                return User::role(['user', 'admin'])->get();
            });

            $ideas_count = cache()->remember('ideas_count', 300, function () {
                return Idea::where('status_id', 1)->count();
            });

            $taskStatuses = [3, 7, 5];

            $counts = cache()->remember('task_counts', 300, function () use ($taskStatuses) {
                return TaskModel::whereIn('status_id', $taskStatuses)
                    ->selectRaw('status_id, COUNT(*) as count')
                    ->groupBy('status_id')
                    ->pluck('count', 'status_id');
            });

            $ready = $counts->get(3, 0);
            $all_tasks = $counts->sum();
            $out_of_date = $counts->get(7, 0);
            $rejected = $counts->get(5, 0);

            $settings = cache()->remember('settings', 300, function () {
                return Setting::first();
            });

            $projectTasksOfDashboardAdmin = cache()->remember('project_tasks_admin', 300, function () {
                return DB::table('project_models as p')
                    ->leftJoin('task_models as t', 'p.id', '=', 't.project_id')
                    ->where('t.deleted_at', '=', null)
                    ->select('p.name as name', 'p.id as id',
                        DB::raw('COUNT(t.id) as count_task'),
                        DB::raw('COUNT(CASE WHEN t.status_id = 3 THEN 1 ELSE NULL END) as count_ready'),
                        DB::raw('COUNT(CASE WHEN t.status_id = 2 OR t.status_id = 4 THEN 1 ELSE NULL END) as count_process'),
                        DB::raw('COUNT(CASE WHEN t.status_id = 10 THEN 1 ELSE NULL END) as count_verificateClient'),
                        DB::raw('COUNT(CASE WHEN t.status_id = 6 OR t.status_id = 14 THEN 1 ELSE NULL END) as count_verificateAdmin'),
                        DB::raw('COUNT(CASE WHEN t.status_id = 7 THEN 1 ELSE NULL END) as count_outOfDate'),
                        DB::raw('COUNT(CASE WHEN t.status_id = 1 OR t.status_id = 5 OR t.status_id = 8 OR t.status_id = 9
                               OR t.status_id = 11 OR t.status_id = 12 OR t.status_id = 13 THEN 1 ELSE NULL END) as count_other')
                    )
                    ->groupBy('p.name', 'p.id')
                    ->get();
            });

            //TODO НАЙТИ И УДАЛИТЬ
            $notifications = cache()->remember('client_notifications', 300, function () {
                return ClientNotification::count();
            });

            //TODO НАЙТИ И УДАЛИТЬ
            $newMessage = cache()->remember('chat_messages_' . Auth::id(), 300, function () {
                return ChatMessageModel::where('user_id', Auth::id())->orWhere('offer_id', Auth::id())->orderBy('created_at', 'desc')->get();
            });

            $command_task = cache()->remember('command_task_count', 300, function () {
                return CreateMyCommandTaskModel::count();
            });

            $usersTelegram = cache()->remember('users_telegram', 3000, function () {
                return User::role('user')->get();
            });

            $ideasOfDashboard = cache()->remember('ideas_dashboard', 1, function () {
                return Idea::with('status', 'user')->get();
            });

            $systemIdeasOfDashboard = cache()->remember('system_ideas_dashboard', 1000, function () {
                return SystemIdea::with('status', 'user')->get();
            });

            $system_idea_count = cache()->remember('system_idea_count', 300, function () {
                return SystemIdea::where('status_id', 1)->count();
            });

            $leadStatuses = cache()->remember('lead_statuses', 300, function () {
                return LeadStatus::all();
            });

            $monthInRu = cache()->remember('task_types', 300, function () {
                return TaskTypesTypeModel::all();
            });

            $months = ['Январь' => 'January',  'Февраль' => 'February', 'Март' => 'March', 'Апрель' => 'April', 'Май' => 'May', 'Июнь' => 'June', 'Июль' => 'July',
                'Авуст' => 'August', 'Сентябрь' => 'September', 'Октябрь' => 'October', 'Ноябрь' => 'November', 'Декабрь' => 'December'];

            $dataByMonth = [];

            $employees = cache()->remember('employees', 600, function () {
                return User::role('user')->get();
            });

            $plans = cache()->remember('my_plans_count', 40, function () {
                return User\MyPlanModel::count();
            });

            $project = cache()->remember('user_project_' . Auth::id(), 500, function () {
                return DB::table('project_clients as pc')
                    ->join('project_models as p','p.id', 'pc.project_id')
                    ->join('users as u', 'u.id', 'pc.user_id')
                    ->select('p.is_active')
                    ->where('u.id', Auth::id())
                    ->first();
            });

            $leadStatusIds = [1, 2, 3, 4, 5, 6, 7];

            foreach ($months as $month) {
                $monthTimestamp = strtotime($month);
                $monthNumber = date('m', $monthTimestamp);

                $counts = cache()->remember('lead_counts_month_' . $monthNumber, 300, function () use ($leadStatusIds, $monthNumber) {
                    return Lead::whereIn('lead_status_id', $leadStatusIds)
                        ->whereMonth('created_at', $monthNumber)
                        ->groupBy('lead_status_id')
                        ->selectRaw('lead_status_id, COUNT(*) as count')
                        ->pluck('count', 'lead_status_id');
                });

                $dataByMonth[$month] = [
                    'count' => $counts->sum(),
                    'first_meet' => $counts->get(1, 0),
                    'potential_client' => $counts->get(2, 0),
                    'treaty' => $counts->get(3, 0),
                    'payment' => $counts->get(4, 0),
                    'unquality_lead' => $counts->get(5, 0),
                    'test_stage' => $counts->get(6, 0),
                    'kp' => $counts->get(7, 0),
                ];
            }

            $taskType = cache()->remember('fsdfsfs', 300, function () {
                return TaskTypeModel::get();
            });

            $users1 = cache()->remember('fsfsdf', 60, function () {
                return User::role(['user', 'admin'])->get() ;
            });


            $projectTasksOfDashboardUser = cache()->remember('project_tasks_user_' . Auth::id(), 300, function () {
                return DB::table('project_models as p')
                    ->leftJoin('task_models as t', 'p.id', '=', 't.project_id')
                    ->where([
                        ['user_id', Auth::id()],
                        ['t.deleted_at', '=', null]
                    ])
                    ->select('p.name as name',
                        DB::raw('COUNT(t.id) as count_task_user'),
                        DB::raw('COUNT(CASE WHEN t.status_id = 3 THEN 1 ELSE NULL END) as count_task_ready'),
                        DB::raw('COUNT(CASE WHEN t.status_id = 2 OR t.status_id = 4 THEN 1 ELSE NULL END) as count_task_progress'),
                        DB::raw('COUNT(CASE WHEN t.status_id = 10 THEN 1 ELSE NULL END) as count_task_verificateClient'),
                        DB::raw('COUNT(CASE WHEN t.status_id = 6 OR t.status_id = 14 THEN 1 ELSE NULL END) as count_task_verificateAdmin'),
                        DB::raw('COUNT(CASE WHEN t.status_id = 7 THEN 1 ELSE NULL END) as count_task_outOfDate'),
                        DB::raw('COUNT(CASE WHEN t.status_id = 1 OR t.status_id = 5 OR t.status_id = 8 OR t.status_id = 9
                               OR t.status_id = 11 OR t.status_id = 12 OR t.status_id = 13 THEN 1 ELSE NULL END) as count_task_other')
                    )->groupBy('p.name')
                    ->get();
            });

            $ideasOfDashboardUser = cache()->remember('ideas_user_dashboard_' . Auth::id(), 1000, function () {
                return Idea::where('user_id', Auth::id())->with('status', 'user')->get();
            });

            $systemIdeasOfDashboardUser = cache()->remember('system_ideas_user_dashboard_' . Auth::id(), 1000, function () {
                return SystemIdea::where('user_id', Auth::id())->with('status', 'user')->get();
            });

            $notes = cache()->remember('user_notes_' . Auth::id(), 300, function () {
                return $this->notesList(Auth::id());
            });



            view()->share([
                'projectTasksOfDashboardUser' => $projectTasksOfDashboardUser,
                'ideasOfDashboardUser' => $ideasOfDashboardUser,
                'systemIdeasOfDashboardUser' => $systemIdeasOfDashboardUser,
                'notes' => $notes,
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
                'projectTasksOfDashboardAdmin' => $projectTasksOfDashboardAdmin,
                'ideasOfDashboard' => $ideasOfDashboard,
                'systemIdeasOfDashboard' => $systemIdeasOfDashboard,
                'statistics' => $statistics,
                'types' => $taskType,
                'projects1' => ProjectModel::where('pro_status', '!=', 3)->get(),
                'users1'  => $users1,
                'system_idea_count' => $system_idea_count,
                'leadStatuses' => $leadStatuses,
                'months' => $months,
                'dataByMonth' => $dataByMonth,
                'monthInRu' => $monthInRu,
                'settings' => $settings,
                'project' => $project,
                'employees' => $employees,
                'plans' => $plans

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

    public function employeePlan($employeePlan, $days)
    {
        return cache()->remember('vdd', 5, function () use ($employeePlan, $days) {
            $formattedDate = date("Y-m-d", strtotime($days));
            $plans = MyPlanModel::whereDate('created_at', '=', $formattedDate)->where('user_id', $employeePlan)->get();

            return response([
                'plans' => $plans
            ]);
        });


    }
    public function notesList($userID)
    {
        return cache()->remember('vdd', 5, function () use($userID) {
            return NotesModels::where('user_id', $userID)->get();
        });

    }

}
