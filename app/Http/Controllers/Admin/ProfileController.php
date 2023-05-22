<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseController;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ProfileUpdateRequest;
use App\Models\Admin\OtdelsModel;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class ProfileController extends BaseController
{
    public function index()
    {
        $user = User::findOrFail(Auth::id());
        $employees = User::role('user')->get();
        return view('admin.profile.index', compact('user', 'employees'));
    }

    public function edit()
    {
        $user = User::findOrFail(Auth::id());
        $otdel = OtdelsModel::where('id', $user->otdel_id)->first();
        $otdels = OtdelsModel::where('id', '!=', $user->otdel_id)->get();
        return view('admin.profile.edit', compact('user', 'otdel', 'otdels'));
    }

    public function update(ProfileUpdateRequest $request)
    {

        $data = $request->validated();

        $user = User::findOrFail(Auth::id());
        $file = $user->avatar;

        if ($request->hasFile('avatar')) {
            $newFile = $request->file('avatar')->store('user_img');
            if ($newFile !== $file) {
                if ($file !== null) {
                    Storage::delete($file);
                }
                $file = $newFile;
            }
        }

        $user->update([
            'name' => $data['name'],
            'surname' => $data['surname'],
            'lastname' => $data['lastname'],
            'phone' => $data['phone'],
            'otdel_id' => $data['otdel_id'],
            'telegram_user_id' => $data['telegram_id'],
            'avatar' => $file
        ]);
        return redirect()->route('profile.index')->with('success', 'Данные обновлены');
    }

    public function show()
    {
        $user = User::findOrFail(Auth::id());
        $otdel = OtdelsModel::where('id', $user->otdel_id)->first();
        return view('admin.profile.show', compact('user', 'otdel'));
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
            return back()->with('success', 'Пароль был успешно изменен!');
        } else {
            return back()->with('error', 'Старый пароль неверен!');
        }
    }
}
