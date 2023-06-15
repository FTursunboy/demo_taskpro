<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Admin\TasksController;
use App\Http\Controllers\BaseController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\HistoryController;
use App\Models\Admin\MessagesModel;
use App\Models\Admin\ProjectModel;
use App\Models\Admin\TaskModel;
use App\Models\Admin\TaskTypeModel;
use App\Models\Admin\TaskTypesTypeModel;
use App\Models\Client\Offer;
use App\Models\History;
use App\Models\Statuses;
use App\Models\User;
use App\Notifications\Telegram\Chat;
use App\Notifications\Telegram\SendNewTaskInUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class GetAllTasksController extends BaseController
{
    public function index()
    {
        $tasks = TaskModel::where('user_id', Auth::id())->get();
        return view('user.all-tasks.index', compact('tasks'));
    }

    public function show(TaskModel $task)
    {
        $messages = MessagesModel::where('task_slug', $task->slug)->get();

        $histories = History::where([
            ['task_id', '=', $task->id],
            ['type', '=', 'task']
        ])->get();
        return view('user.all-tasks.show', compact('task', 'messages', 'histories'));
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
                    Notification::send(User::find($task->user_id), new Chat($messages_models, $task->name, $task->id));
                    Notification::send(User::find(1), new Chat($messages_models, $task->name, $task->id));
                } catch (\Exception $exception) {

                }

        return response([
            'messages' => $messages_models,
            'name' => $messages_models->sender->name,
            'created_at' => date('d.m.Y H:i:s', strtotime($messages_models->created_at))
        ]);
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
