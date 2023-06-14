<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\BaseController;
use App\Http\Controllers\Controller;
use App\Models\Admin\MessagesModel;
use App\Models\Admin\TaskModel;
use App\Models\ChatMessageModel;
use App\Models\Client\Offer;
use App\Models\User;
use App\Notifications\Telegram\Chat;
use App\Notifications\Telegram\SendNewTaskInUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Storage;
use function Symfony\Component\String\b;

class ChatController extends BaseController
{
    public function index(Offer $offer)
    {
        $messages = MessagesModel::where('task_slug', $offer->slug)->get();

        return view('client.offers.chat', compact('messages', 'offer'));
    }

    public function store(Request $request, Offer $offer)
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
            'task_slug' => $offer->slug,
            'user_id' => $offer->user_id ?: null,
            'file' => $file ?? null,
            'file_name' => $request->file('file') ? $request->file('file')->getClientOriginalName() : null,
            'sender_id' => Auth::id(),
        ]);
        $task = TaskModel::where('offer_id', $offer->id);
        try {
            Notification::send(User::find($offer->user_id), new Chat($messages_models, $offer->name, $offer->id));
            Notification::send(User::find(1), new Chat($messages_models, $offer->name, ($task) ? $task->id : $offer->id));
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

    public function delete(MessagesModel $mess) {
        $mess->delete();
        return back();
    }

}
