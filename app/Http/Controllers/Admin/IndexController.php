<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseController;
use App\Models\Admin\ProjectModel;
use App\Models\Admin\StatusesModel;
use App\Models\Admin\TaskModel;
use App\Models\Client\Rating;
use App\Models\ClientNotification;
use App\Models\User;

use Carbon\Carbon;
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

        $admin_users = User::select('users.id', 'users.name', 'users.surname', 'users.lastname', 'users.login', 'users.avatar', 'users.phone', 'users.position', 'users.xp')
            ->selectRaw('AVG(admin_ratings.rating) AS average_rating')
            ->leftJoin('admin_ratings', 'users.id', '=', 'admin_ratings.user_id')
            ->whereHas('roles', function ($query) {
                $query->where('name', 'user');
            })
            ->groupBy('users.id', 'users.name', 'users.surname', 'users.lastname', 'users.login', 'users.avatar', 'users.phone', 'users.position', 'users.xp')
            ->where('admin_ratings.rating', '>', 0)
            ->orderBy('average_rating', 'desc')
            ->take(5)
            ->get();


        $task = $this->countTasks();

        $tasks = ProjectModel::get()->take(5);

        $team_leads = Auth::user()->TeamLeadProject()->take(5);

        $ratings = DB::table('ratings as r')
            ->join('users as u', 'u.id', 'r.user_id')
            ->join('users as c', 'c.id', 'r.client_id')
            ->join('task_models as t', 't.slug', 'r.task_slug')
            ->select('u.name AS perfomer_name', 'u.surname AS perfomer_surname', 'u.lastname AS perfomer_lastname', 'c.*', 't.name as task', 'r.rating', 'r.reason')
            ->orderByDesc('r.rating')
            ->get();


        $admin_ratings = DB::table('admin_ratings as r')
            ->join('users as u', 'u.id', 'r.user_id')
            ->join('task_models as t', 't.id', 'r.task_id')
            ->select('u.name AS perfomer_name', 'u.surname AS perfomer_surname', 'u.lastname AS perfomer_lastname', 't.name as task', 'r.rating')
            ->orderByDesc('r.rating')
            ->get();



        $statistics = User::role('user')->get();


        return view('admin.index', compact('task', 'statistics', 'users', 'tasks', 'team_leads', 'ratings', 'admin_users', 'admin_ratings'));
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
        $all = TaskModel::count();
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

    public function clientVerification()
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


        $today = Carbon::now();
        $endRange = $today->copy()->addDays(11);
        $startMonthDay = $today->format('m-d');
        $endMonthDay = $endRange->format('m-d');

        if ($endRange->isBefore($today)) {
            $startMonthDay = '12-31';
            $endMonthDay = $endRange->format('m-d');
            $endRange = $endRange->copy()->addYear();
        }

        $birthdays = User::role('user')
            ->whereRaw('DATE_FORMAT(birthday, "%m-%d") >= ?', [$startMonthDay])
            ->whereRaw('DATE_FORMAT(birthday, "%m-%d") <= ?', [$endMonthDay])
            ->orderByRaw('DATE_FORMAT(birthday, "%m-%d")')
            ->get();

        return $birthdays;

    }

    public function filter($month)
    {
        return $this->getFilter($month);
    }

    public function getFilter($month)
    {
        $arrs = [];
        $users = User::role('user')->get();
        foreach ($users as $user) {
            $arrs[] = [
                'user' => $user->name . " " . $user->surname,
                'total' => $user->getUserTasksInMonth($month, $user->id)['total'],
                'debt' => $user->getUserTasksInMonth($month, $user->id)['debt'],
                'process' => $user->getUserTasksInMonth($month, $user->id)['process'],
                'accept' => $user->getUserTasksInMonth($month, $user->id)['accept'],
                'ready' => $user->getUserTasksInMonth($month, $user->id)['ready'],
                'speed' => $user->getUserTasksInMonth($month, $user->id)['speed'],
                'expected' => $user->getUserTasksInMonth($month, $user->id)['expected'],
                'expectedAdmin' => $user->getUserTasksInMonth($month, $user->id)['expectedAdmin'],
                'expectedUser' => $user->getUserTasksInMonth($month, $user->id)['expectedUser'],
                'forVerification' => $user->getUserTasksInMonth($month, $user->id)['forVerification'],
                'forVerificationAdmin' => $user->getUserTasksInMonth($month, $user->id)['forVerificationAdmin'],
                'forVerificationClient' => $user->getUserTasksInMonth($month, $user->id)['forVerificationClient'],
                'rejected' => $user->getUserTasksInMonth($month, $user->id)['rejected'],
                'rejectedAdmin' => $user->getUserTasksInMonth($month, $user->id)['rejectedAdmin'],
                'rejectedClient' => $user->getUserTasksInMonth($month, $user->id)['rejectedClient'],
            ];
        }
//dd($arrs);

        return response([
                'statistics' => $arrs,
        ]);
    }

}
