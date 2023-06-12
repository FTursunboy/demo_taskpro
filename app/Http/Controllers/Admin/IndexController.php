<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\BaseController;
use App\Http\Controllers\Controller;
use App\Models\Admin\TaskModel;
use App\Models\ClientNotification;
use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

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
            ->groupBy('users.id', 'users.name', 'users.surname', 'users.lastname', 'users.login', 'users.avatar', 'users.phone',  'users.position', 'users.xp')
            ->where('ratings.rating', '>', 0)
            ->orderBy('average_rating', 'desc')
            ->take(5)
            ->get();

        $task = $this->countTasks();

        $crmRole = Role::where('name', 'crm')->first();
        $crm = User::role($crmRole)->get();

        return view('admin.index', compact('task', 'users', 'crm'));
    }
    public function delete(ClientNotification $offer) {

        $offer->delete();

        return redirect()->route('client.offers.show', $offer->offer_id);
    }
    public function countTasks()
    {
        $success = TaskModel::where('status_id', 3)->count();
        $inProgress = TaskModel::where('status_id', 6)
            ->orWhere('status_id', 10)
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

    public function progress()
    {
        $inProgress = TaskModel::where('status_id', 6)
            ->orWhere('status_id', 10)
            ->orWhere('status_id', 14)->get();
        $users = User::role(['user', 'admin'])->get();

        return view('admin.tasks.inProgress', compact('inProgress', 'users'));
    }



}
