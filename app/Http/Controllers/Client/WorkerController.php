<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\BaseController;
use App\Http\Controllers\Controller;
use App\Http\Requests\Client\WokerRequest;
use App\Models\Admin\OtdelsModel;
use App\Models\Client\Offer;
use App\Models\ClientGroup;
use App\Models\ProjectClient;
use App\Models\User;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Role;
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
            'surname' => $request->surname,
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

    public function edit($slug)
    {
        $user = User::where('slug', $slug)->firstOrFail();

        return view('client.workers.edit', compact('user'));
    }

    public function update($slug, WokerRequest $request)
    {

        $worker = User::where('slug', $slug)->firstOrFail();
        $file = $worker->avatar;

        if ($request->hasFile('avatar')) {
            $newFile = $request->file('avatar')->store('public/user_img/');
            if ($newFile !== $file) {
                if ($file !== null) {
                    Storage::delete($file);
                }
                $file = $newFile;
            }
        }

        $worker->update([
            'name' => $request->name,
            'lastname' => $request->lastname,
            'phone' => $request->phone,
            'surname' => $request->surname,
            'password' => Hash::make($request->password ?? 'password'),
            'avatar' => $file,
        ]);




        return redirect()->route('client.workers.index')->with('mess', 'Сотрудник успешно создан');
    }

    public function destroy($slug)
    {
        $worker = User::where('slug', $slug)->firstOrFail();

        $worker->delete();
        return redirect()->route('client.workers.index')->with('delete', "Сотрудник успешно удален!");
    }
}
