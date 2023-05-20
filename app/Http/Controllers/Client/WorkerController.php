<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\BaseController;
use App\Http\Controllers\Controller;
use App\Http\Requests\Client\WokerRequest;
use App\Models\Client\Offer;
use App\Models\ClientGroup;
use App\Models\ProjectClient;
use App\Models\User;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\Request;


class WorkerController extends BaseController
{
    public function index()
    {
        $users = User::role('client-worker')->get();

        return view('client.workers.index', compact('users'));
    }

    public function store(WokerRequest $request)
    {
        $user = User::create([
            'name' => $request->name,
            'lastname' => $request->lastname,
            'phone' => $request->phone,

            'position' => $request->position,
             'slug' => Str::slug($request->name . '-' . rand(0, 5), '-'),

            'login' => $request->login,
            'password' => Hash::make($request->password),
        ]);
        $user->assignRole('client-worker');

        $project = ProjectClient::where('user_id', Auth::user()->id)->first();

        ProjectClient::create([
            'user_id' => $user->id,
            'project_id' => $project->project_id,
        ]);
        ClientGroup::create([
            'user_id' => $user->id,
            'client_id' => Auth::id(),
        ]);

        return redirect()->back()->with('mess', 'Сотрудник успешно создан');

    }

    public function show(User $user)
    {
        $tasks = Offer::where('client_id', $user->id)->get();

        return view('client.workers.show', compact('tasks', 'user'));
    }

}
