<?php

namespace App\Http\Controllers\API\V1\Tasks;

use App\Http\Controllers\Controller;
use App\Http\Controllers\HistoryController;
use App\Http\Resources\API\V1\Tasks\GetTasksResource;
use App\Http\Resources\API\V1\Tasks\NewTasksResource;
use App\Http\Resources\API\V1\Tasks\TasksResource;
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

class TaskController extends Controller
{
    public function index(User $user)
    {
        return response([
            'message' => true,
            'tasks' => TasksResource::collection(TaskModel::where('user_id', $user->id)->get())
        ]);
    }

    public function newTasks(User $user)
    {
        return response([
            'message' => true,
            'tasks' => NewTasksResource::collection($user->getNewTasks($user->id))
        ]);
    }

    public function getTasks(User $user)
    {
        return response([
            'message' => true,
            'tasks' => GetTasksResource::collection($user->getUsersTasks($user->id)),
        ]);
    }

    public function taskAccept(User $user, TaskModel $task)
    {
        UserTaskHistoryModel::create([
            'user_id' => $user->id,
            'task_id' => $task->id,
            'status_id' => 4,
        ]);
        $task->update([
            'status_id' => 4
        ]);
        if ($task->to < now()->toDateString()) {
            $task->status_id = 7;
            $task->save();
        }

        HistoryController::task($task->id, $task->user_id, Statuses::ACCEPT);

        if ($task->offer_id) {
            $offer = Offer::find($task->offer_id);
            $offer->status_id = 2;
            $offer->save();
            HistoryController::client($offer->id, $offer->user_id, $offer->client_id, Statuses::ACCEPT);

        }
        try {
            Notification::send(User::role('admin')->first(), new TelegramUserAccept($task->name, $user->name));
        } catch (\Exception $exception) {
        }
        Artisan::call('update:task-status');
        return response([
            'message' => true,
            'info' => 'Задача принята!',
            'task' => new TasksResource($task),
        ]);
    }
    public function taskDecline(User $user, TaskModel $task, Request $request)
    {
        $cancelReason = $request->input('cancel');

        if (empty($cancelReason)) {
            return response([
                'message' => false,
                'info' => 'Введите причину отмены!',
            ]);
        }
        if ($task->status_id === 7){
            $task->update([
                'status_id' => 1,
            ]);
        }

        $task->update([
            'cancel' => $request->cancel,
            'status_id' => 5,
        ]);

        HistoryController::task($task->id, $task->user_id, Statuses::DECLINED);

        if ($task->offer_id) {
            $offer = Offer::find($task->offer_id);
            $offer->cancel = $request->cancel;
            $offer->status_id = 12;
            $offer->save();
            HistoryController::client($offer->id, $offer->user_id, $offer->client_id, Statuses::DECLINED);
        }
        try {
            Notification::send(User::role('admin')->first(), new TelegramUserDecline($task->name, $user->name));
        } catch (\Exception $exception) {

        }
        Artisan::call('update:task-status');
        return response([
            'message' => true,
            'info' => 'Задача отклонено!',
        ]);
    }
}
