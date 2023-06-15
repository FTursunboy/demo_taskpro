<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseController;
use App\Models\Admin\ProjectModel;
use App\Models\Admin\TaskModel;
use App\Models\Client\Rating;
use App\Models\ClientNotification;
use App\Models\User;

use Illuminate\Support\Facades\Auth;

use Illuminate\Console\View\Components\Task;

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
            ->join('task_models as t', 't.slug', 'r.task_slug')
            ->select( 'u.name AS perfomer_name', 'u.surname AS perfomer_surname', 'u.lastname AS perfomer_lastname',  'c.*', 't.name as task', 'r.rating')
            ->orderByDesc('r.rating')
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
        $inProgress = TaskModel::where('status_id', 2)
            ->orWhere('status_id', 4)->count();
        $speed = TaskModel::where('status_id', 7)->count();
        $clientVerification = TaskModel::where('status_id', 10)->count();
        $adminVerification = TaskModel::where('status_id', 6)->orWhere('status_id', 14)->count();
        $all = TaskModel::where('status_id', '!=', 3)->count();
        return [
            'success' => $success,
            'inProgress' => $inProgress,
            'speed' => $speed,
            'all' => $all,
            'clientVerification' => $clientVerification,
            'adminVerification' => $adminVerification,
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

    public function  clientVerification()
    {
        $clientVerifications = TaskModel::where('status_id', 10)->count();

        return view('admin.tasks.clientVerification', compact('clientVerifications'));
    }

    public function adminVerification()
    {
        $adminVerifications = TaskModel::where('status_id', 6)->orWhere('status_id', 14)->count();

        return view('admin.tasks.clientVerification', compact('adminVerifications'));
    }

    public function birthday()
    {
        $birthdays = User::role('user')
            ->whereRaw('DATEDIFF(birthday, CURDATE()) <= 3')
            ->whereRaw('DATEDIFF(birthday, CURDATE()) >= 0')
            ->get();
        return $birthdays;

    }

}
