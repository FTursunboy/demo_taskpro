<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\BaseController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\UserBaseController;
use App\Http\Requests\User\UpdateProfileRequest;
use App\Models\Admin\OtdelsModel;
use App\Models\ClientMail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class ProfileController extends UserBaseController
{
    public function index()
    {
        $user = User::findOrFail(Auth::id());
        $employees = User::role('user')->orderBy('xp', 'desc')->get();
        $task = User::where('id', Auth::id())->first()->countTasks(Auth::id());
        $tasks = User::findOrFail(Auth::id())->getUsersTasks(Auth::id());
        $departs = OtdelsModel::get();

        return view('user.profile.index', compact('user', 'departs', 'task', 'tasks', 'employees'));
    }

    public function update(UpdateProfileRequest $request)
    {
        $data = $request->validated();
        $user = User::findOrFail(Auth::id());

        if ($request->file('avatar') !== null) {
            if ($user->avatar !== null) {
                Storage::disk('public')->delete($user->avatar);
            }
            $file = Storage::disk('public')->put('/user_img', $request->file('avatar'));
        } else {
            $file = $user->avatar;
        }

        $user->update([
            'name' => $data['name'],
            'surname' => $data['surname'],
            'lastname' => $data['lastname'],
            'phone' => $data['phone'],
            'birthday' => $data['birthday'],
            'avatar' => $file,
        ]);

        $clientMail = ClientMail::where('user_id', $user->id)->first();
        if ($clientMail) {
            $clientMail->update([
                'email' => $data['email'],
            ]);
        } else {
            ClientMail::create([
                'user_id' => $user->id,
                'email' => $data['email'],
            ]);
        }

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
        if (Hash::check($data['oldPassword'], $user->password)) {
            $user->update([
                'password' => Hash::make($data['password'])
            ]);
            return redirect()->route('user_profile.index', $user->id)->with('update', 'Пароль был успешно изменен!');
        } else {
            return redirect()->route('user_profile.index', $user->id)->with('error', 'Старый пароль неверен!');
        }
    }
}
