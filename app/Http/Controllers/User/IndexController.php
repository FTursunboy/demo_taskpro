<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\BaseController;
use App\Http\Controllers\Controller;
use App\Models\Admin\MessagesModel;
use App\Models\Admin\TaskModel;
use App\Models\Client\Offer;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class IndexController extends BaseController
{

    public function index()
    {
//
//        $plans = new MyPlanController();
//        $myPlan = $plans->myPlan(Auth::id(), Carbon::now()->format('Y-m-d'));
////        dd(count($myPlan));
//        if (count($myPlan) === 0) {
//            return  redirect()->route('plan.index')->with('create', 'Пожалуйста сначала создадите план на сегондня');
//        }
        $task = User::where('id', Auth::id())->first()->countTasks(Auth::id());
        $user = User::where('id', Auth::id())->first();
        $tasks = User::findOrFail(Auth::id())->getUsersTasks(Auth::id());
        $tasks_count = TaskModel::where([
            ['user_id', '=', Auth::id()],
            ['status_id', '=', '10']
        ])->count();
        $rejectClientCount = TaskModel::where([
            ['user_id', '=', Auth::id()],
            ['status_id', '=', '13']
        ])->count();
        $ver_admin = TaskModel::where([
            ['user_id', '=', Auth::id()],
            ['status_id', '=', '6'],
            ['client_id', '=', null]
        ])->count();
        $new_tasks = TaskModel::where('user_id', Auth::id())
            ->where('status_id', 9)
            ->where('status_id', 1)->count();

        $newTasks = User::findOrFail(Auth::id())->getNewTasks(Auth::id());
        $tasksInProgress = TaskModel::where('user_id', Auth::id())
            ->where('status_id', 2)->get();
        $tasksSpeed = TaskModel::where('user_id', Auth::id())
            ->where('status_id', 7)->get();
        $tasksVerAdmin = TaskModel::where('user_id', Auth::id())
            ->where('status_id', 6)
            ->where('client_id', null)->get();
        $tasksVerClient = TaskModel::where('user_id', Auth::id())
            ->where('status_id', 10)->get();
        $tasksReject = TaskModel::where('user_id', Auth::id())
            ->where('status_id', 13)->get();
        $tasksInArchive = TaskModel::where('user_id', Auth::id())
            ->where('status_id', 3)->get();
        return view('user.index', compact('task', 'user', 'tasks',
            'tasks_count', 'rejectClientCount', 'ver_admin', 'new_tasks', 'newTasks', 'tasksInProgress',
            'tasksSpeed', 'tasksVerAdmin', 'tasksVerClient', 'tasksReject', 'tasksInArchive'));
    }

    public function downloadFile(TaskModel $task)
    {
        $path = storage_path('app/' . $task->file);
        $headers = [
            'Content-Type' => 'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
            'Content-Disposition' => 'attachment; filename="' . $task->file_name . '"',
        ];

        return response()->download($path, $task->file_name, $headers);
    }

    public function downloadFileChat(MessagesModel $task)
    {
        $path = storage_path('app/' . $task->file);
        $headers = [
            'Content-Type' => 'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
            'Content-Disposition' => 'attachment; filename="' . $task->file_name . '"',
        ];

        return response()->download($path, $task->file_name, $headers);
    }

    public function verificate_client()
    {
        $clientVerification = TaskModel::where([
            ['user_id', '=', Auth::id()],
            ['status_id', '=', '10']
        ])->get();


        return view('user.tasks.verificate_client', compact('clientVerification'));
    }

    public function reject_client()
    {
        $rejectClient = TaskModel::where([
            ['user_id', '=', Auth::id()],
            ['status_id', '=', '13']
        ])->get();

    }

    public function chart()
    {


        $tasks = TaskModel::where('user_id', Auth::id())
            ->whereMonth('from', Carbon::now()->month)
            ->whereMonth('to', Carbon::now()->month)
            ->get()
            ->count();
   
        $tasks_ready = TaskModel::where('user_id', Auth::id())
            ->whereIn('status_id', [3, 10])
            ->whereMonth('from', Carbon::now()->month)
            ->whereMonth('to', Carbon::now()->month)
            ->get()
            ->count();

        $result = ($tasks_ready / $tasks) * 100;

        return response([
           'result' => round($result)
        ]);

    }
}
