<?php

namespace App\Http\Controllers;

use App\Models\Admin\TasksClient;
use App\Models\Client\Offer;
use App\Models\SystemIdea;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ClientBaseController extends Controller
{
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $systemIdeasOfDashboardClient = cache()->remember('system_ideas_client_dashboard_' . Auth::id(), 1000, function () {
                return SystemIdea::where('user_id', Auth::id())->with('status', 'user')->get();
            });

            $client_tasks = cache()->remember('client_tasks_' . Auth::id(), 300, function () {
                return TasksClient::where('client_id', Auth::id())->count();
            });

            $expected_admin = cache()->remember('expected_admin_' . Auth::id(), 300, function () {
                return Offer::where([
                    ['client_id', Auth::id()],
                    ['status_id', 8]
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

            $project = cache()->remember('user_project_' . Auth::id(), 500, function () {
                return DB::table('project_clients as pc')
                    ->join('project_models as p','p.id', 'pc.project_id')
                    ->join('users as u', 'u.id', 'pc.user_id')
                    ->select('p.is_active')
                    ->where('u.id', Auth::id())
                    ->first();
            });

            view()->share([
               'systemIdeasOfDashboardClient' => $systemIdeasOfDashboardClient,
                'client_tasks' => $client_tasks,
                'expected_admin' => $expected_admin,
                'cancel_admin' => $cancel_admin,
                'client_reject' => $client_reject,
                'in_progress' => $in_progress,
                'project' => $project,
            ]);
            return $next($request);
        });
    }
}
