<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

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

        } else {

        }
    }
}
