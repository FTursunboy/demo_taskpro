<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseController;
use App\Http\Controllers\Controller;
use App\Models\Admin\MessagesModel;
use App\Models\Client\Offer;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Request;


class ChatController extends BaseController
{
    public function index(Offer $offer) {

        $messages  = MessagesModel::where('task_slug', $offer->slug)->get();


        return view('admin.offers.chat', compact('messages', 'offer'));
    }

    public function store(Request $request, Offer $offer) {

        $data = $request->validate([
            'message' => 'required',
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
