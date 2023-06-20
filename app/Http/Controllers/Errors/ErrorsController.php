<?php

namespace App\Http\Controllers\Errors;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ErrorsController extends Controller
{
    public function error404()
    {
        Auth::logout();
        return redirect()->route('login');
    }
    public function send404()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}
