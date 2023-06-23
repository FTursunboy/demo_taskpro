<?php

namespace App\Http\Controllers\Mail;

use App\Http\Controllers\Controller;
use App\Mail\ChatEmail;
use App\Mail\Send;
use App\Mail\SendReportToClient;
use App\Mail\SendTaskToClient;
use App\Models\Client\Offer;
use Illuminate\Support\Facades\Mail;

class MailToSendClientController extends Controller
{
    public static function send($email, $reportClient) {
        Mail::to($email)->send(new SendReportToClient($reportClient));
    }
    public static function chat($email, $task, $message) {
        Mail::to($email)->send(new ChatEmail($task, $message));
    }
    public static function send_task_to_client($email, $task) {
        Mail::to('tfaiziev04@gmail.com')->send(new SendTaskToClient($task));
    }

}
