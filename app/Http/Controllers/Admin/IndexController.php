<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\BaseController;
use App\Http\Controllers\Controller;
use App\Models\Admin\TaskModel;
use App\Models\ClientNotification;
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
        $UnSuccess = TaskModel::where('status_id', 5)->count();
        $speed = TaskModel::where('status_id', 7)->count();
        $all = TaskModel::count();
        return [
            'success' => $success,
            'unSuccess' => $UnSuccess,
            'speed' => $speed,
            'all' => $all
        ];
    }
}
