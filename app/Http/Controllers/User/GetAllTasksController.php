<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Admin\TasksController;
use App\Http\Controllers\BaseController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\HistoryController;
use App\Http\Controllers\Mail\MailToSendClientController;
use App\Http\Controllers\ReportHistoryController;
use App\Models\Admin\MessagesModel;
use App\Models\Admin\ProjectModel;
use App\Models\Admin\TaskModel;
use App\Models\Admin\TaskTypeModel;
use App\Models\Admin\TaskTypesTypeModel;
use App\Models\Client\Offer;
use App\Models\History;
use App\Models\ReportHistory;
use App\Models\Statuses;
use App\Models\User;
use App\Notifications\Telegram\Chat;
use App\Notifications\Telegram\SendNewTaskInUser;
use App\Notifications\Telegram\TelegramReady;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class GetAllTasksController extends BaseController
{
    public function index()
    {
        $tasks = TaskModel::where('user_id', Auth::id())
            ->where('status_id', '!=', 3)->get();
        return view('user.all-tasks.index', compact('tasks'));
    }

    public function show($slug)
    {
        $task = TaskModel::where('slug', $slug)->first();

        $admin = User::role('admin')->first();

        $messages = MessagesModel::where('task_slug', $task->slug)->get();

        $reports = ReportHistory::where('task_slug', $slug)->get();
        $histories = History::where([
            ['task_id', '=', $task->id],
            ['type', '=', 'task']
        ])->get();
        return view('user.all-tasks.show', compact('task', 'messages', 'histories', 'admin', 'reports'));
    }

    public function store(Request $request, TaskModel $task)
    {
        $data = $request->validate([
            'message' => 'required',
        ]);

        if ($request->file('file') !== null) {
            $file = $request->file('file')->store('public/chat_docs');
        } else {
            $file = null;
        }

        $messages_models =  MessagesModel::create([
            'message' => $data['message'],
            'task_slug' => $task->slug,
            'user_id' => $task->user_id ?: null,
            'file' => $file ?? null,
            'file_name' => $request->file('file') ? $request->file('file')->getClientOriginalName() : null,
            'sender_id' => Auth::id(),
        ]);

                try {
                    Notification::send(User::find(1), new Chat($messages_models, $task->name, $task->id));
                } catch (\Exception $exception) {

                }

        return response([
            'messages' => $messages_models,
            'name' => $messages_models->sender->name,
            'created_at' => date('d.m.Y H:i:s', strtotime($messages_models->created_at))
        ]);
    }


    public function ready(TaskModel $task, Request $request)
        {
            $request->validate([
                'success_desc' => 'required',
            ]);

            $h = new TaskListController();
            $h->stopDeadline($task);

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

            return redirect()->route('all-tasks.index')->with('create', 'Задача отправлена на проверку!');
        }

        public function resend(TaskModel $task, Request $request) {

            $request->validate([
                'success_desc' => 'required',
            ]);

            ReportHistoryController::create(
                $task->slug,
                Statuses::CONFIRM,
                $request->input('success_desc')
            );

            $h = new TaskListController();
            $h->stopDeadline($task);

            $successDesc = $request->input('success_desc');

            $task->update([
                'status_id' => 10,
                'success_desc' => $successDesc,
            ]);
            $offer = Offer::find($task->offer_id);
            $offer->is_finished = true;
            $offer->status_id = 10;
            $offer->save();

            $client = User::find($task->client_id);
            $email = $client?->clientEmail?->email;
            $taskName = $task->name;
            MailToSendClientController::send($email, $taskName);

            HistoryController::task($task->id, $task->user_id, Statuses::SEND_TO_TEST);


            return redirect()->route('all-tasks.index')->with('create', 'Задача отправлена на проверку!');
        }

    public function downloadFile(MessagesModel $mess)
    {
        $path = storage_path('app/' . $mess->file);
        $headers = [
            'Content-Type' => 'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
            'Content-Disposition' => 'attachment; filename="' . $mess->file_name . '"',
        ];

        return response()->download($path, $mess->file_name, $headers);
    }


}
