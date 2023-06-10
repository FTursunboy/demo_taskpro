<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Mail\MailController;
use App\Http\Controllers\Mail\MailToSendClientController;
use App\Mail\SendReportToClient;
use App\Models\Admin\TaskModel;
use App\Models\Client\Offer;
use App\Models\Report;
use App\Models\User;
use App\Notifications\Telegram\SendNewTaskInUser;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Request;

class MyTasksController extends BaseController
{
    public function index()
    {
        $users = User::role('admin')->get();
        $tasks = TaskModel::orderBy('created_at', 'desc')->where('status_id', '!=', 3)->where('user_id', auth()->id())->get();
        $this->check();
        return view('admin.tasks.index', compact('tasks', 'users'));
    }

    public function check()
    {
        $tasks = TaskModel::orderBy('created_at', 'desc')->get();
        foreach ($tasks as $task) {
            if ($task->to < now()->toDateString()) {
                if ($task->status_id !== 3 && $task->status_id !== 5 && $task->status_id !== 6 && $task->status_id !== 10 && $task->status_id !== 11 && $task->status_id !== 12 && $task->status_id !== 13 && $task->status_id !== 14) {
                    $task->status_id = 7;
                    $task->save();
                }
            }
        }
        return $tasks;
    }

    public function done(TaskModel $task)
    {

        if ($task->client_id == null) {
            $task->update([
                'status_id' => 3,
                'finish' => Carbon::now(),
            ]);

            return redirect()->route('mytasks.index')->with('update', 'Задача успешно завершена!');
        } else {
            $task->update([
                'status_id' => 10,
            ]);
            $offer = Offer::find($task->offer_id);
            $offer->status_id = 10;
            $offer->save();

            try {
                $client = User::find($offer->client_id);
                $email = $client->clientEmail->email;

                $taskName = $task->name;


                MailToSendClientController::send($email, $taskName);
            } catch (\Exception $exception) {

            }

            return redirect()->route('mytasks.index')->with('update', 'Задача успешно завершена!');
        }

    }


}
