<?php

namespace App\Http\Controllers;

use App\Models\History;
use Faker\Provider\Base;
use Illuminate\Support\Facades\Auth;


class HistoryController extends BaseController
{

    public static function task($task_id, $user_id, $status_id) {
        History::create([
            'task_id' => $task_id,
            'user_id' => $user_id,
            'status_id' => $status_id,
            'type' => 'task',
            'sender_id' => Auth::id(),
        ]);
    }
    public static function client($task_id, $user_id, $client_id, $status_id) {
        History::create([
            'task_id' => $task_id,
            'user_id' => $user_id,
            'client_id' => $client_id,
            'status_id' => $status_id,
            'type' => 'offer',
            'sender_id' => Auth::id(),
        ]);
    }

    public static function project($task_id, $status_id) {
        History::create([
            'task_id' => $task_id,
            'status_id' => $status_id,
            'type' => 'project',
            'sender_id' => Auth::id(),
        ]);
    }

    public static function out_of_date($task_id) {
        History::create([
            'task_id' => $task_id,
            'status_id' => 7,
            'type' => 'offer',
            'sender_id' => 35,
            'user_id' => 35
        ]);
    }
}
