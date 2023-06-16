<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\AdminRatingRequest;
use App\Models\Admin\AdminRating;
use App\Models\Admin\TaskModel;
use App\Models\User;
use Illuminate\Http\Request;

class AdminRatingController extends Controller
{
    public function score(AdminRatingRequest $request)
    {
        $id = $request->input('session');

        $rating = $request->input('rating');
        $task = TaskModel::find($id);
        $user = User::find($task->user_id);

        AdminRating::updateOrCreate(
//            ['task_slug' => $task->slug],
            [
                'rating' => $rating,
                'user_id' => $user->id,
                'task_id' => $task->id,
            ]
        );
        session()->forget('mess');
        session()->forget('task1');
        return redirect()->back()->with('update', 'Спасибо за отзыв');
    }
}
