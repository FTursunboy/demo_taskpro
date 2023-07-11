<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class AddFriendController extends Controller
{
    public function store(Request $request)
    {
        try {
            $user = Auth::user()->account;
            $response = Http::post("http://www.billing.taskpro.tj/billing/public/api/referal/store/$user", [
                'client_name' => $request->client_name,
                'phone' => $request->phone
            ]);


            $message = $response->json('message');


            if ($response->successful()) {
                $mess = $response->json('message');

                if ($response->json('info') == "Успешно отправлено") {
                    $settings = Setting::first();
                    $settings->invited_friends++;
                    $settings->save();
                    $sms = new SmsSenderController();
                    $sms->send($request->phone);


                    return redirect()->back()->with("create", $response->json('info'));
                }else{
                    return redirect()->back()->with("error", $response->json('info'));
                }
            }
        } catch (\Exception $e) {

            return 'Произошла ошибка: ' . $e->getMessage();
        }
    }

}
