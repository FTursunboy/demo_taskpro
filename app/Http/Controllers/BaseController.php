<?php

namespace App\Http\Controllers;

use App\Models\ClientNotification;
use Illuminate\Http\Request;
use Illuminate\View\View;

class BaseController extends Controller
{
        public function __construct()
        {
            $notifications = ClientNotification::get();

            return view()->share('notifications', $notifications);
        }
}
