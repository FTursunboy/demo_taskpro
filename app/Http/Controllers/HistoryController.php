<?php

namespace App\Http\Controllers;

use App\Models\History;


class HistoryController extends Controller
{
    public static function task($task_id, $user_id, $status_id) {
        History::create([
            'task_id' => $task_id,
            'user_id' => $user_id,
            'status_id' => $status_id,
            'type' => 'task'
        ]);
    }
    public static function client($task_id, $user_id, $client_id, $status_id) {
        History::create([
            'task_id' => $task_id,
            'user_id' => $user_id,
            'client_id' => $client_id,
            'status_id' => $status_id,
            'type' => 'offer'
        ]);
    }

    public static function project($task_id, $status_id) {
        History::create([
            'task_id' => $task_id,
            'status_id' => $status_id,
            'type' => 'project'
        ]);
    }
}
