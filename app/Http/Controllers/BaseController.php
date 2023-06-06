<?php

namespace App\Http\Controllers;

use App\Models\Admin\TaskModel;
use App\Models\ChatMessageModel;
use App\Models\Client\Offer;
use App\Models\ClientNotification;
use Illuminate\Support\Facades\Auth;

class BaseController extends Controller
{
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $offers_count = Offer::where('user_id', null)->get()->count();

            $ready = TaskModel::where('status_id', 3)->get()->count();
            $all_tasks = TaskModel::get()->count();
            $out_of_date = TaskModel::where('status_id', 7)->count();
            $rejected = TaskModel::where('status_id', 5)->count();

            $notifications = ClientNotification::get();
            $newMessage = ChatMessageModel::where('user_id', Auth::id())->orwhere('offer_id', Auth::id())->orderBy('created_at','desc')->get();
            view()->share([
                'notifications' => $notifications,
                'newMessage' => $newMessage,
                'offers_count' => $offers_count,
                'ready' => $ready,
                'all_tasks' => $all_tasks,
                'out_of_date' => $out_of_date,
                'rejected' => $rejected
            ]);
            return $next($request);

        });
    }
}
