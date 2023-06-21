<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\BaseController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\HistoryController;
use App\Http\Controllers\ReportHistoryController;
use App\Models\Admin\MessagesModel;
use App\Models\Admin\TaskModel;
use App\Models\Admin\UserTaskHistoryModel;
use App\Models\ChatMessageModel;
use App\Models\CheckDate;
use App\Models\Client\Offer;
use App\Models\Statuses;
use App\Models\User;
use App\Notifications\Telegram\TelegramReady;
use App\Notifications\Telegram\TelegramUserAccept;
use App\Notifications\Telegram\TelegramUserDecline;
use Carbon\Carbon;
use Database\Factories\UserFactory;
use Illuminate\Console\View\Components\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;

class TaskListController extends BaseController
{
    public function show($slug)
    {
        $task = TaskModel::where('slug', $slug)->first();
        $admin = User::role('admin')->first();
        $messages = MessagesModel::where('task_slug', $task->slug)->get();
        return view('user.tasks.show', compact('task', 'messages', 'admin'));
    }

    public function removeNotification(TaskModel $task)
    {
        $mess = ChatMessageModel::where('task_id', $task->id)->first();
        $mess?->delete();
        return redirect()->route('task-list.show', $task->id);
    }

    public function ready(TaskModel $task, Request $request)
    {
        $request->validate([
            'success_desc' => 'required',
        ]);
        ReportHistoryController::create($task->slug, Statuses::SEND_TO_TEST, $request->success_desc);

        $this->stopDeadline($task);

        $successDesc = $request->input('success_desc');

        $task->update([
            'status_id' => 6,
            'success_desc' => $successDesc,
        ]);


        HistoryController::task($task->id, $task->user_id, Statuses::SEND_TO_TEST);

        if ($task->offer_id) {


            $offer = Offer::find($task->offer_id);
            $offer->status_id = 6;
            $offer->save();

            HistoryController::client($offer->id, $offer->user_id, $offer->client_id, Statuses::SEND_TO_TEST);
        }

        try {
            Notification::send(User::role('admin')->first(), new TelegramReady($task->name, Auth::user()->name));
        } catch (\Exception $exception) {

        }

        return redirect()->route('user.index')->with('create', 'Задача отправлена на проверку!');
    }

    public function decline(TaskModel $task, Request $request)
    {
        $request->validate(['cancel' => ['required']]);

        ReportHistoryController::create(
            $task->slug,
            Statuses::CONFIRM,
            $request->input('cancel')
        );

        $decline = UserTaskHistoryModel::where([
            'user_id' => Auth::id(),
            'task_id' => $task->id,
            'status_id' => $task->status_id
        ])->first();

        ReportHistoryController::create($task->slug, Statuses::DECLINED, $request->cancel);

        $decline?->delete();

        $task->update([
            'status_id' => 5,
            'cancel' => $request->input('cancel'),
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
            Notification::send(User::role('admin')->first(), new TelegramUserDecline($task->name, Auth::user()->name));
        } catch (\Exception $exception) {
        }
        Artisan::call('update:task-status');
        return redirect()->route('user.index')->with('delete', 'Задача отклонена!');
    }

    public function stopDeadline(TaskModel $task)
    {
        $data = CheckDate::where('task_id', $task->id)->first();
        if ($data) {
            $date = Carbon::now();
            $current_date = $date->format('Y-m-d');
            $deadLine = $data->deadline;
            $minus = Carbon::create($deadLine);

            $result = $date->diff($minus);

            $data->count = $result->format('%a');
            $data->save();
        }

    }
}
