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
                return ProjectModel::withCount('tasks')->orderByDesc('tasks_count')->get();
            });

            $projectTasksOfDashboardUser = cache()->remember('project_tasks_user_' . Auth::id(), 300, function () {
                return TaskModel::where('user_id', Auth::id())->get();
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

            $ideasOfDashboard = cache()->remember('ideas_dashboard', 1000, function () {
                return Idea::get();
            });

            $ideasOfDashboardUser = cache()->remember('ideas_user_dashboard_' . Auth::id(), 1000, function () {
                return Idea::where('user_id', Auth::id())->get();
            });

            $systemIdeasOfDashboard = cache()->remember('system_ideas_dashboard', 1000, function () {
                return SystemIdea::get();
            });

            $systemIdeasOfDashboardUser = cache()->remember('system_ideas_user_dashboard_' . Auth::id(), 1000, function () {
                return SystemIdea::where('user_id', Auth::id())->get();
            });

            $system_idea_count = cache()->remember('system_idea_count', 300, function () {
                return SystemIdea::where('status_id', 1)->count();
            });

            $systemIdeasOfDashboardClient = cache()->remember('system_ideas_client_dashboard_' . Auth::id(), 1000, function () {
                return SystemIdea::where('user_id', Auth::id())->get();
            });

            $notes = cache()->remember('user_notes_' . Auth::id(), 300, function () {
                return $this->notesList(Auth::id());
            });

            $client_tasks = cache()->remember('client_tasks_' . Auth::id(), 300, function () {
                return TasksClient::where('client_id', Auth::id())->count();
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

            $expected_admin = cache()->remember('expected_admin_' . Auth::id(), 300, function () {
                return Offer::where([
                    ['client_id', Auth::id()],
                    ['status_id', 8]
                ])->count();
            });

            $admin_verification = cache()->remember('admin_verification_' . Auth::id(), 300, function () {
                return Offer::where([
                    ['client_id', Auth::id()],
                    ['status_id', 14]
                ])->count();
            });

            $cancel_admin = cache()->remember('cancel_admin_' . Auth::id(), 300, function () {
                return Offer::where([
                    ['client_id', Auth::id()],
                    ['status_id', 9]
                ])->count();
            });

            $client_reject = cache()->remember('client_reject_' . Auth::id(), 300, function () {
                return Offer::where([
                    ['client_id', Auth::id()],
                    ['status_id', 13]
                ])->count();
            });

            $in_progress = cache()->remember('in_progress_' . Auth::id(), 180, function () {
                return Offer::where([
                    ['client_id', Auth::id()]
                ])->whereIn('status_id', [2, 7])->count();
            });

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
                'projectTasksOfDashboardAdmin' => $projectTasksOfDashboardAdmin,
                'projectTasksOfDashboardUser' => $projectTasksOfDashboardUser,
                'ideasOfDashboard' => $ideasOfDashboard,
                'ideasOfDashboardUser' => $ideasOfDashboardUser,
                'systemIdeasOfDashboard' => $systemIdeasOfDashboard,
                'systemIdeasOfDashboardUser' => $systemIdeasOfDashboardUser,
                'systemIdeasOfDashboardClient' => $systemIdeasOfDashboardClient,
                'statistics' => $statistics,
                'notes' => $notes,
                'types' => TaskTypeModel::get(),
                'projects1' => ProjectModel::where('pro_status', '!=', 3)->get(),
                'users1'  => User::role(['user', 'admin'])->get(),
                'client_tasks' => $client_tasks,
                'system_idea_count' => $system_idea_count,
                'leadStatuses' => $leadStatuses,
                'months' => $months,
                'dataByMonth' => $dataByMonth,
                'monthInRu' => $monthInRu,
                'admin_verification' => $admin_verification,
                'expected_admin' => $expected_admin,
                'client_reject' => $client_reject,
                'cancel_admin' => $cancel_admin,
                'in_progress' => $in_progress,
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
        $formattedDate = date("Y-m-d", strtotime($days));
        $plans = MyPlanModel::whereDate('created_at', '=', $formattedDate)->where('user_id', $employeePlan)->get();

        return response([
            'plans' => $plans
        ]);

    }
    public function notesList($userID)
    {
        return NotesModels::where('user_id', $userID)->get();
    }

}
