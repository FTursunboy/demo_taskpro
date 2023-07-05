<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class AddFriendController extends Controller
{
    public function store(Request $request)
    {
        try {
            $user = Auth::user()->account;
            $response = Http::post("http://www.billng.fingroup.tj/billing/public/api/referal/store/$user", [
                'name' => $request->name,
                'lastname' => $request->lastname,
                'email' => $request->email,
                'phone' => $request->phone
            ]);


            $message = $response->json('message');


            if ($response->successful()) {
                $mess = $response->json('message');

                if ($response->json('info') == "Успешно отправлено") {
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
