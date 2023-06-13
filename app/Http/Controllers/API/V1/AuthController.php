<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\API\V1\Auth\AuthResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(Request $request){
        $user = User::where('login', $request->login)->first();
        if (!$user || !Hash::check($request->password, $user->password)) {
            return response([
                'message' => false,
                'info' => 'Пароль или логин введены неправильно'
            ]);
        }
        $token = $user->createToken('android-token')->plainTextToken;
        $this->user = $user;
        $response = [
            'message' => true,
            'user' => new AuthResource($user),
            'token' => $token
        ];
        return response($response);
    }
}
