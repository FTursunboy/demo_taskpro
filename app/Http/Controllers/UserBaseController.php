<?php

namespace App\Http\Controllers;

use App\Models\Idea;
use App\Models\SystemIdea;
use App\Models\Users\NotesModels;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UserBaseController extends Controller
{
    public function __construct()
    {
        $this->middleware(function ($request, $next) {

            $projectTasksOfDashboardUser = cache()->remember('project_tasks_user_' . Auth::id(), 300, function () {
                return DB::table('project_models as p')
                    ->leftJoin('task_models as t', 'p.id', '=', 't.project_id')
                    ->where('user_id', Auth::id())
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
            ]);
            return $next($request);
        });
    }

    public function notesList($userID)
    {
        return cache()->remember('vdd', 5, function () use($userID) {
            return NotesModels::where('user_id', $userID)->get();
        });

    }
}
