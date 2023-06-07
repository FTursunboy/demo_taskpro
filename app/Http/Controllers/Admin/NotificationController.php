<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\MessagesModel;
use App\Models\Admin\TaskModel;
use Illuminate\Http\Request;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\DB;

class NotificationController extends Controller
{
    public function index() {

        $tasks = DB::table('task_models', );

        $notification = MessagesModel::where('task_slug', )->get();


    }
}
