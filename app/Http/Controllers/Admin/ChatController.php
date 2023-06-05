<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseController;
use App\Http\Controllers\Controller;
use App\Models\Admin\MessagesModel;
use App\Models\ChatMessageModel;
use App\Models\Client\Offer;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Request;


class ChatController extends BaseController
{
    public function index(Offer $offer)
    {

        $messages = MessagesModel::where('task_slug', $offer->slug)->get();


        return view('admin.offers.chat', compact('messages', 'offer'));
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

        MessagesModel::create([
            'message' => $data['message'],
            'task_slug' => $offer->slug,
            'user_id' => $offer->user_id,
            'sender_id' => Auth::id(),
            'file' => $file ?? null,
            'file_name' => $request->file('file') ? $request->file('file')->getClientOriginalName() : null,

        ]);

        return redirect()->back();
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
