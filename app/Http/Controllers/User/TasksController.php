<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\BaseController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\HistoryController;
use App\Http\Controllers\ReportHistoryController;
use App\Models\Admin\MessagesModel;
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

class TasksController extends BaseController
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
            'status_id' => 2,
        ]);
        $task->update([
            'status_id' => 2
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
            Notification::send(User::role('admin')->first(), new TelegramUserAccept($task->name, Auth::user()->name));
        } catch (\Exception $exception) {
        }
        Artisan::call('update:task-status');
        return redirect()->route('task-list.show', $task->slug)->with('create', 'Задача принята!');
    }

    public function decline(TaskModel $task, Request $request)
    {
        if ($task->status_id === 7){
            $task->update([
                'status_id' => 1,
            ]);
        }


        $task->update([
            'cancel' => $request->cancel,
            'status_id' => 5,
        ]);

        ReportHistoryController::create(
            $task->slug,
            Statuses::RESEND,
            $request->input('cancel')
        );


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
        return back()->with('error', 'Задача отклонена!');
    }
    public function download_file_chat(MessagesModel $mess)  {
        $path = storage_path('app/public/' . $mess->file);

        $headers = [
            'Content-Type' => 'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
            'Content-Disposition' => 'attachment; filename="' . $mess->file_name . '"',
        ];

        return response()->download($path, $mess->file_name, $headers);

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
}
