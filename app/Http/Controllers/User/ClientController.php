<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\BaseController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\UserBaseController;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ClientController extends UserBaseController
{
    public function index() {
        $users = User::role('client')
            ->leftJoin('offers', 'users.id', '=', 'offers.client_id')
            ->leftJoin('project_clients as pc', 'pc.user_id', 'users.id')
            ->leftJoin('project_models as p', 'p.id', 'pc.project_id')
            ->select('users.id', 'users.phone', 'p.name as project', 'users.name', 'users.slug', 'users.surname', 'users.last_seen', DB::raw('COUNT(offers.id) as offers_count'), DB::raw('SUM(offers.status_id = 3) as status2_count'))
            ->groupBy('users.id', 'users.name', 'users.phone', 'p.name', 'users.slug', 'users.surname', 'users.last_seen')
            ->get();
        return view('user.clients.index', compact('users'));
    }
}
