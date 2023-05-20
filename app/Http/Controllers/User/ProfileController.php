<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\BaseController;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\UpdateProfileRequest;
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
        $task = User::where('id', Auth::id())->first()->countTasks(Auth::id());
        $tasks = User::findOrFail(Auth::id())->getUsersTasks(Auth::id());
        $departs = OtdelsModel::get();
        return view('user.profile.index', compact('user', 'departs', 'task', 'tasks', 'employees'));
    }

    public function update(UpdateProfileRequest $request)
    {
        $data = $request->validated();
        $file = Auth::user()->avatar;

        if ($request->hasFile('avatar')) {
            $newFile = $request->file('avatar')->store('public/user_img/');
            if ($newFile !== $file) {
                if ($file !== null) {
                    Storage::delete($file);
                }
                $file = $newFile;
            }
        }

        Auth::user()->update([
            'name' => $data['name'],
            'surname' => $data['surname'],
            'lastname' => $data['lastname'],
            'phone' => $data['phone'],
            'avatar' => $file,
        ]);

        return redirect()->route('user_profile.index')->with('update', "Данные успешно изменены!");
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
            return redirect()->route('user_profile.index', $user->id)->with('update', 'Пароль был успешно изменен!');
        } else {
            return redirect()->route('user_profile.index', $user->id)->with('error', 'Старый пароль неверен!');
        }
    }
}
