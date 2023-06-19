<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Mail\MailToSendClientController;
use App\Jobs\ChatSendEmailClientJob;
use App\Jobs\ChatTelegramNotificationAdminJob;
use App\Mail\ChatEmail;
use App\Mail\Send;
use App\Models\Admin\MessagesModel;
use App\Models\Admin\TaskModel;
use App\Models\ChatMessageModel;
use App\Models\Client\Offer;
use App\Models\User;
use App\Notifications\Telegram\Chat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Notification;


class MessagesController extends BaseController
{
    public function message(Request $request, TaskModel $task)
    {
        $user_id = User::role('admin')->first();

        if ($request->file('file') !== null) {
            $file = $request->file('file')->store('public/chat_docs');
        } else {
            $file = null;
        }

        $messages_models = MessagesModel::create([
            'task_slug' => $task->slug,
            'sender_id' => Auth::id(),
            'user_id' => ($task->offer_id !== null) ? $task->client_id : $user_id->id,
            'file' => $file ?? null,
            'file_name' => $request->file('file') ? $request->file('file')->getClientOriginalName() : null,
            'message' => $request->message
        ]);


    

        ChatTelegramNotificationAdminJob::dispatch($messages_models, $task->name, $task->id);


        return response([
            'messages' => $messages_models,
            'name' => $messages_models->sender->name,
            'created_at' => date('d.m.Y H:i:s', strtotime($messages_models->created_at))
        ]);
    }

    public function delete(MessagesModel $mess)
    {
        $mess->delete();
        return back();
    }


}
