<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Notifications\Telegram\SendNewPassword;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Notification;

class ForgotController extends Controller
{
    public function index()
    {
        return view('auth.forgot');
    }

    public function update(Request $request)
    {
        $user = User::where('login', '=', $request->login)->first();

        if ($user !== null) {
            try {
               Notification::send(SendNewPassword::class, $user);
            } catch (\Exception $exception) {
                dd($exception->getMessage());
            }
        } else {
            return redirect()->route('forgot.index')->with('error', 'Вы ввели неправильный пароль');
        }
        return redirect()->route('login');
    }
}
