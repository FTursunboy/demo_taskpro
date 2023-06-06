<?php

namespace App\Http\Controllers\Mail;

use App\Http\Controllers\Controller;
use App\Mail\Send;
use App\Mail\SendReportToAdmin;
use App\Models\Admin\EmailModel;
use App\Models\Report;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller
{

    public function send($email){
//        Mail::to($email)->send(new Send());

    }
    public static function report(Report $report) {

        $email = EmailModel::first()->email;

        Mail::to($email)->send(new SendReportToAdmin($report));
    }
}
