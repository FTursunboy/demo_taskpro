<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Client\Offer;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IndexController extends Controller
{
    public function index()
    {
        $tasks = Offer::where([
            ['client_id', '=', Auth::id()],
            ['status_id', '=', '6'],
            ['is_finished', '=', true]
        ])->get();

        return view('client.index', compact('tasks'));
    }

}
