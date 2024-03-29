<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseController;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Notifications\Telegram\TelegramSendAllUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;

class TelegramController extends BaseController
{
    public function sendAll(Request $request)
    {
        try {
            $users = User::role('user')->get();
            foreach ($users as $user) {
                try {
                    Notification::send($user, new TelegramSendAllUsers($request->message));
                } catch (\Exception $exception) {

                }
            }
            return back()->with('create', 'Сообщение успешно отправлено!');
        } catch (\Exception $exception) {

        }
        return [];
    }

    public function sendOne(User $user, Request $request)
    {
        try {
            Notification::send($user, new TelegramSendAllUsers($request->message));
        } catch (\Exception $exception) {

        }
        return back()->with('create', 'Сообщение успешно отправлено!');
    }
}
