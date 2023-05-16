<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Http\Requests\Client\UpdateClientRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function index(User $user)
    {
        //$user = User::findOrFail(Auth::id());

        return view('client.profile.index', compact('user'));
    }

    public function update(User $client, UpdateClientRequest $request)
    {
        $data = $request->validated();
        $client->update([
            'name' => $data['name'],
            'surname' => $data['surname'],
            'lastname' => $data['lastname'],
            'phone' => $data['phone'],
            'password' => Hash::make($data['password'] ?? 'password')
        ]);
        return redirect()->route('edit_profile.index', $client->id)->with('update', "Клиент успешно изменен!");
    }

    public function password(Request $request)
    {
        $data = $request->validate([
            'oldPassword' => ['required'],
            'password' => ['required', 'confirmed'],
        ], [
            'oldPassword.required' => 'Введите старый пароль',
            'password.required' => 'Введите новый пароль',
            'password.confirmed' => 'Пароли не совпадают',
        ]);

        $user = User::where('id', Auth::id())->first();
        if (Hash::check($data['oldPassword'] ,$user->password)) {
            $user->update([
                'password' => Hash::make($data['password'])
            ]);
            return back()->with('update', 'Пароль был успешно изменен!');
        } else {
            return back()->with('error', 'Старый пароль неверен!');
        }
    }
}
