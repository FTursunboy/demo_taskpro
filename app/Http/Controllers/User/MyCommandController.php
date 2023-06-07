<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MyCommandController extends Controller
{
    public function index()
    {
        $commands = User::where('otdel_id', Auth::user()->otdel_id)->get();
        return view('user.my-command.index', compact('commands'));
    }
}
