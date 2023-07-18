<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\API\V1\Auth\AuthResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $user = User::where('login', $request->login)->first();

        if ($request->file('avatar') !== null) {
            if ($user->avatar !== null) {
                Storage::disk('public')->delete($user->avatar);
            }
            $file = Storage::disk('public')->put('/user_img', $request->file('avatar'));
        } else {
            $file = $user->avatar;
        }

        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json([
                'message' => 'Пароль или логин введены неправильно'
            ], 401);
        }
        $token = $user->createToken('android-token')->plainTextToken;
        $this->user = $user;
        return response()->json([
            'message' => true,
            'token' => $token,
            'user' => new AuthResource($user),
            'avatar' => '/tasks/public'.Storage::url($file)
        ]);
    }


    public function logout()
    {
        auth()->user()->tokens()->delete();
        return response([
            'message' => true,
            'info' => 'Вы успешно вышли из системы. До встречи!'
        ]);
    }


}
