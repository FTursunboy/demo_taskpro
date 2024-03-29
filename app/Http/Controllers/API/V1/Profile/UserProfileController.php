<?php

namespace App\Http\Controllers\API\V1\Profile;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ProfileUpdateRequest;
use App\Http\Resources\API\V1\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UserProfileController extends Controller
{
    public function index($id)
    {
        $user = User::findorfail($id);


        $file = $user->avatar;


        return response([
            'message' => true,
            'user' => new UserResource($user),
            'avatar' => '/tasks/public'.Storage::url($file)
        ]);
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        if ($request->file('avatar') !== null) {
            if ($user->avatar !== null) {
                Storage::disk('public')->delete($user->avatar);
            }
            $file = Storage::disk('public')->put('/user_img', $request->file('avatar'));
        } else {
            $file = $user->avatar;
        }

        $user->update([
            'name' => $request->name ?? $user->name,
            'surname' => $request->surname ?? $user->surname,
            'lastname' => $request->lastname ?? $user->lastname,
            'phone' => $request->phone ?? $user->phone,
            'avatar' => $file
        ]);

        return response([
            'message' => true,
            'user' => new UserResource($user),
            'avatar' => '/tasks/public'.Storage::url($file)
        ]);
    }

}
