<?php

namespace App\Http\Controllers;

use App\Models\ChatMessageModel;
use App\Models\ClientNotification;
use Illuminate\Support\Facades\Auth;

class BaseController extends Controller
{
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $notifications = ClientNotification::get();
            $newMessage = ChatMessageModel::where('user_id', Auth::id())->orwhere('offer_id', Auth::id())->orderBy('created_at','desc')->get();
            view()->share([
                'notifications' => $notifications,
                'newMessage' => $newMessage,
            ]);
            return $next($request);

        });
    }
}
