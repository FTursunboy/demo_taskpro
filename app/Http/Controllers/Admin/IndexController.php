<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseController;
use App\Models\Admin\ProjectModel;
use App\Models\Admin\TaskModel;
use App\Models\ClientNotification;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class IndexController extends BaseController
{
    public function index()
    {
        $users = User::select('users.id', 'users.name', 'users.surname', 'users.lastname', 'users.login', 'users.avatar', 'users.phone', 'users.position', 'users.xp')
            ->selectRaw('AVG(ratings.rating) AS average_rating')
            ->leftJoin('ratings', 'users.id', '=', 'ratings.user_id')
            ->whereHas('roles', function ($query) {
                $query->where('name', 'user');
            })
            ->groupBy('users.id', 'users.name', 'users.surname', 'users.lastname', 'users.login', 'users.avatar', 'users.phone', 'users.position', 'users.xp')
            ->where('ratings.rating', '>', 0)
            ->orderBy('average_rating', 'desc')
            ->take(5)
            ->get();

        $task = $this->countTasks();

        $tasks = ProjectModel::get()->take(5);

        $team_leads = Auth::user()->TeamLeadProject();

        $ratings = DB::table('ratings as r')
            ->join('users as u', 'u.id', 'r.user_id')
            ->join('users as c', 'c.id', 'r.client_id')
            ->join('task_models as t', 't.id', 'r.task_id')
            ->select( 'u.*', 'u.surname', 'c.*', 'c.name as client', 't.name as task', 'r.rating')
            ->get();


        return view('admin.index', compact('task', 'users', 'tasks', 'team_leads', 'ratings'));
    }

    public function delete(ClientNotification $offer)
    {

        $offer->delete();

        return redirect()->route('client.offers.show', $offer->offer_id);
    }

    public function countTasks()
    {
        $success = TaskModel::where('status_id', 3)->count();
        $inProgress = TaskModel::where('status_id', 6)
            ->orWhere('status_id', 14)->count();
        $speed = TaskModel::where('status_id', 7)->count();
        $all = TaskModel::count();
        return [
            'success' => $success,
            'inProgress' => $inProgress,
            'speed' => $speed,
            'all' => $all
        ];
    }

    public function speed()
    {
        $speeds = TaskModel::where('status_id', 7)->get();
        $users = User::role(['user', 'admin'])->get();

        return view('admin.tasks.speed', compact('speeds', 'users'));
    }

    public function success()
    {
        $success = TaskModel::where('status_id', 3)->get();

        return view('admin.tasks.success', compact('success'));
    }


}
