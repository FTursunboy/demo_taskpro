<?php

namespace App\Http\Controllers;

use App\Models\Admin\TaskModel;
use App\Models\Client\Offer;
use App\Models\ReportHistory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReportHistoryController extends Controller
{
    public static function create($task_slug, $status_id, $text) {

        ReportHistory::create([
            'task_slug' => $task_slug,
            'sender_id' => Auth::id(),
            'status_id' => $status_id,
            'offer_id' => null,
            'text' => $text,
        ]);
    }
}
