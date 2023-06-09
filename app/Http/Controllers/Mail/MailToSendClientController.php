<?php

namespace App\Http\Controllers\Mail;

use App\Http\Controllers\Controller;
use App\Mail\Send;
use App\Mail\SendReportToClient;
use Illuminate\Support\Facades\Mail;

class MailToSendClientController extends Controller
{
    public static function send($email, $reportClient) {
        Mail::to($email)->send(new SendReportToClient($reportClient));
    }

}
