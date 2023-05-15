<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseController;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends BaseController
{
    public function index()
    {
        $user = User::findOrFail(Auth::id());
        $employees = User::role('user')->get();
        return view('admin.profile.index', compact('user', 'employees'));
    }

    public function password(Request $request)
    {
        $data = $request->validate([
            'oldPassword' => ['required'],
            'password' => ['required', 'confirmed'],
        ], [
            'oldPassword.required' => 'Введите старый пароль',
            'password.required' => 'Выедите новый пароль',
            'password.confirmed' => 'Пароли не совпадают',
        ]);

        $user = User::where('id', Auth::id())->first();
        if (Hash::check($data['oldPassword'] ,$user->password)) {
            $user->update([
                'password' => Hash::make($data['password'])
            ]);
            return back()->with('success', 'Пароль был успешно изменен');
        } else {
            return back()->with('error', 'Старый пароль неверен!');
        }
    }
}
