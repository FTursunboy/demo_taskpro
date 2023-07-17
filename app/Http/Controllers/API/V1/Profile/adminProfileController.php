<?php

namespace App\Http\Controllers\API\V1\Profile;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ProfileUpdateRequest;
use App\Http\Resources\API\V1\UserResource;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;


class adminProfileController extends Controller
{
    public function index($id)
    {

        return response([
           'message' => true,
           'user' => UserResource::collection(User::where('id', $id)->get())
        ]);
    }

    public function update(ProfileUpdateRequest $request, $id)
    {
        $data = $request->validated();
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
            'name' => $data['name'],
            'surname' => $data['surname'],
            'lastname' => $data['lastname'] ?? null,
            'phone' => $data['phone'],
            'avatar' => $file
        ]);

        return response([
            'message' => 'Данные обновлены',
            'user' => new UserResource($user)
        ]);
    }
}
