<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\BaseController;
use App\Http\Controllers\Controller;
use App\Models\Admin\MessagesModel;
use App\Models\ChatMessageModel;
use App\Models\Client\Offer;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChatController extends BaseController
{
    public function index(Offer $offer)
    {
        $messages = MessagesModel::where('task_slug', $offer->slug)->get();
        return view('client.offers.chat', compact('messages', 'offer'));
    }

    public function store(\Symfony\Component\HttpFoundation\Request $request, Offer $offer)
    {


        $data = $request->validate([
            'message' => 'required',
        ]);


        ChatMessageModel::create([
            'task_id' => $offer->id,
            'user_id' => $offer->user_id,
            'message' => $data['message'],
            'offer_id' => User::role('admin')->first()->id,
        ]);
        MessagesModel::create([
            'message' => $data['message'],
            'task_slug' => $offer->slug,
            'user_id' => $offer->user_id,
            'sender_id' => Auth::id(),
        ]);

        return redirect()->back();
    }
}
