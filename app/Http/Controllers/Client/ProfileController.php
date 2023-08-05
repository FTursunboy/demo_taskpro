<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\BaseController;
use App\Http\Controllers\ClientBaseController;
use App\Http\Controllers\Controller;
use App\Http\Requests\Client\UpdateClientRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class ProfileController extends ClientBaseController
{
    public function index()
    {
        $user = User::findOrFail(Auth::id());

        return view('client.profile.index', compact('user'));
    }

    public function update(UpdateClientRequest $request)
    {
        $data = $request->validated();

        $client = User::findOrFail(Auth::id());
        if ($request->file('avatar') !== null) {
            if ($client->avatar !== null) {
                Storage::disk('public')->delete($client->avatar);
            }
            $file = Storage::disk('public')->put('/user_img', $request->file('avatar'));
        } else {
            $file = $client->avatar;
        }

        $client->update([
            'name' => $data['name'],
            'surname' => $data['surname'],
            'lastname' => $data['lastname'],
            'phone' => $data['phone'],
            'avatar' => $file,
        ]);
        return redirect()->route('client_profile.index')->with('update', "Клиент успешно изменен!");
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
        if (Hash::check($data['oldPassword'], $user->password)) {
            $user->update([
                'password' => Hash::make($data['password'])
            ]);
            return back()->with('update', 'Пароль был успешно изменен!');
        } else {
            return back()->with('error', 'Старый пароль неверен!');
        }
    }
}
