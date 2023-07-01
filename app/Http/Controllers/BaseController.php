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
            $offers_count = Offer::where([
                ['user_id', null],
                ['status_id', '!=', 11]
            ])->get()->count();
            $statistics = User::role(['user', 'admin'])->get();
            $ideas_count = Idea::where('status_id', 1)->get()->count();
            $ready = TaskModel::where('status_id', 3)->get()->count();
            $all_tasks = TaskModel::get()->count();
            $out_of_date = TaskModel::where('status_id', 7)->count();
            $rejected = TaskModel::where('status_id', 5)->count();

            $projectTasksOfDashboardAdmin = ProjectModel::withCount('tasks')->orderByDesc('tasks_count')->get();
            $projectTasksOfDashboardUser = TaskModel::where('user_id', Auth::id())->get();

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
            $client_tasks = TasksClient::where('client_id', Auth::id())->get()->count();

            $leadStatuses = LeadStatus::all();
            $monthInRu = TaskTypesTypeModel::all();
            $months = ['Январь' => 'January',  'Февраль' => 'February', 'Март' => 'March', 'Апрель' => 'April', 'Май' => 'May', 'Июнь' => 'June', 'Июль' => 'July', 'Авуст' => 'August', 'Сентябрь' => 'September', 'Октябрь' => 'October', 'Ноябрь' => 'November', 'Декабрь' => 'December'];
            $dataByMonth = [];

            foreach ($months as $month) {
                $count = Lead::whereMonth('created_at', '=', date('m', strtotime($month)))->count();
                $first_meet = Lead::where('lead_status_id', 1)->whereMonth('created_at', '=', date('m', strtotime($month)))->count();
                $potential_client = Lead::where('lead_status_id', 2)->whereMonth('created_at', '=', date('m', strtotime($month)))->count();
                $treaty = Lead::where('lead_status_id', 3)->whereMonth('created_at', '=', date('m', strtotime($month)))->count();
                $payment = Lead::where('lead_status_id', 4)->whereMonth('created_at', '=', date('m', strtotime($month)))->count();
                $unquality_lead = Lead::where('lead_status_id', 5)->whereMonth('created_at', '=', date('m', strtotime($month)))->count();
                $test_stage = Lead::where('lead_status_id', 6)->whereMonth('created_at', '=', date('m', strtotime($month)))->count();
                $kp = Lead::where('lead_status_id', 7)->whereMonth('created_at', '=', date('m', strtotime($month)))->count();


                $dataByMonth[$month] = [
                    'count' => $count,
                    'first_meet' => $first_meet,
                    'potential_client' => $potential_client,
                    'treaty' => $treaty,
                    'payment' => $payment,
                    'unquality_lead' => $unquality_lead,
                    'test_stage' => $test_stage,
                    'kp' => $kp,
                ];
            }

            $expected_admin = Offer::where([
                ['client_id', Auth::id()],
                ['status_id', 8]
            ])->count();
            $admin_verification = Offer::where([
                ['client_id', Auth::id()],
                ['status_id', 14]
            ])->count();
            $cancel_admin = Offer::where([
                ['client_id', Auth::id()],
                ['status_id', 11]
            ])->count();
            $client_reject = Offer::where([
                ['client_id', Auth::id()],
                ['status_id', 13]
            ])->count();
            $in_progress = Offer::where([
                ['client_id', Auth::id()]
            ])->whereIn('status_id', [2, 7])->count();



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
                'birthdayUsers' => $birthdayUsers,
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
                'in_progress' => $in_progress

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
