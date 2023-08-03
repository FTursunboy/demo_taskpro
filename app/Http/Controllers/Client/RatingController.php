<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\BaseController;
use App\Http\Controllers\ClientBaseController;
use App\Http\Controllers\Controller;
use App\Http\Requests\Client\RatingRequest;
use App\Models\Admin\TaskModel;
use App\Models\Client\Offer;
use App\Models\Client\Rating;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class RatingController extends ClientBaseController
{

    public function score(Offer $offer, RatingRequest $request)
    {
        $rating = $request->input('rating');
        $user = User::find($offer->user_id);
        $task = TaskModel::where('offer_id', $offer->id)->first();
        $client = User::find($offer->client_id);

        $rating = Rating::updateOrCreate(
            ['task_slug' => $task->slug],
            [
                'rating' => $rating,
                'user_id' => $user->id,
                'client_id' => $client->id,
            ]
        );
        if ($request->reason) {
            $rating->reason = $request->reason;
            $rating->save();
        }

        return redirect()->route('offers.ready', $offer->id)->with('update', 'Спасибо за отзыв');
    }

}
