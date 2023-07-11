<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class SmsSenderController extends Controller
{

    public function send($phone) {
        $config = [
            'login' => 'fingroup',
            'hash' => 'f0dbc1cf10a89595dcce511b6c11cb55',
            'sender' => 'TaskPRO.tj',
            'server' => 'https://api.osonsms.com/sendsms_v1.php'
        ];



        $dlm = ";";
        $phone_number = $phone;
        $txn_id = uniqid();
        $str_hash = hash('sha256', $txn_id.$dlm.$config['login'].$dlm.$config['sender'].$dlm.$phone_number.$dlm.$config['hash']);
        $message = "Здравсвуйте, Вы стали участником реферальной системы http://taskpro.tj";
        $params = [
            "from" => $config['sender'],
            "phone_number" => $phone_number,
            "msg" => $message,
            "str_hash" => $str_hash,
            "txn_id" => $txn_id,
            "login" => $config['login'],
        ];

        $response = Http::get($config['server'], $params);

        if ($response->successful()) {
            $result = $response->json();
            return back();

        } else {
            $error = $response->json();
            return response()->json($error);

        }
    }
}
