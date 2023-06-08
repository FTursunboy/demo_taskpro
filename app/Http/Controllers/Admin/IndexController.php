<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\BaseController;
use App\Http\Controllers\Controller;
use App\Models\Admin\TaskModel;
use App\Models\ClientNotification;
use App\Models\User;
use Illuminate\Http\Request;

class IndexController extends BaseController
{
    public function index()
    {
        $task = $this->countTasks();
        return view('admin.index', compact('task'));
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
