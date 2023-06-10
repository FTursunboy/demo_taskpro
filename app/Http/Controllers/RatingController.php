<?php

namespace App\Http\Controllers;

use App\Http\Requests\Client\RatingRequest;
use App\Models\Admin\TaskModel;
use App\Models\Client\Offer;
use App\Models\Client\Rating;
use App\Models\User;
use Illuminate\Http\Request;

class RatingController extends Controller
{
    public function score(Offer $offer, RatingRequest $request)
    {
        $rating = $request->input('rating');
        dd($rating);
        $user = User::find($offer->user_id);
        $task = TaskModel::find($offer->id);
        $client = User::find($offer->client_id);

        Rating::create([
            'rating' => $rating,
            'user_id' => $user->id,
            'task_id' => $task->id,
            'client_id' => $client->id,
        ]);

        return redirect()->route('client.index')->with('update', 'Спасибо за отзыв');
    }

}
