<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Controllers\HistoryController;
use App\Models\Admin\TaskModel;
use App\Models\Admin\UserTaskHistoryModel;
use App\Models\Client\Offer;
use App\Models\Statuses;
use App\Models\User;
use App\Notifications\Telegram\TelegramUserAccept;
use App\Notifications\Telegram\TelegramUserDecline;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;

class TasksController extends Controller
{
    public function index()
    {
        $tasks = User::findOrFail(Auth::id())->getNewTasks(Auth::id());
        return view('user.task.index', compact('tasks'));

    }

    public function accept(TaskModel $task)
    {
        UserTaskHistoryModel::create([
            'user_id' => Auth::id(),
            'task_id' => $task->id,
            'status_id' => 4,
        ]);
        $task->update([
            'status_id' => 4
        ]);

        HistoryController::task($task->id, $task->user_id, Statuses::ACCEPT);

        if ($task->offer_id) {
            $offer = Offer::find($task->offer_id);
            $offer->status_id = 2;
            $offer->save();
            HistoryController::client($offer->id, $offer->user_id, $offer->client_id, Statuses::ACCEPT);

        }
        try {
            Notification::send(User::role('admin')->first(), new TelegramUserAccept($task->name, Auth::user()->name));
        } catch (\Exception $exception) {
        }
        Artisan::call('update:task-status');
        return back()->with('create', 'Задача принята');
    }

    public function decline(Request $request, TaskModel $task)
    {
        UserTaskHistoryModel::create([
            'user_id' => Auth::id(),
            'task_id' => $task->id,
            'status_id' => 5,
        ]);
        $task->update([
            'cancel' => $request->cancel,
            'status_id' => 5,
        ]);
        HistoryController::task($task->id, $task->user_id, Statuses::DECLINED);

        if ($task->offer_id) {
            $offer = Offer::find($task->offer_id);
            $offer->cancel = $request->cancel;
            $offer->status_id = 2;
            $offer->save();

            HistoryController::client($offer->id, $offer->user_id, $offer->client_id, Statuses::DECLINED);
        }
        try {
            Notification::send(User::role('admin')->first(), new TelegramUserDecline($task->name, Auth::user()->name));
        } catch (\Exception $exception) {
        }
        Artisan::call('update:task-status');
        return back()->with('error', 'Задача откланена');
    }
}
