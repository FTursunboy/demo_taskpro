<?php

namespace App\Http\Controllers\API\V1\Tasks;

use App\Http\Controllers\Controller;
use App\Http\Resources\API\V1\HistoryResource;
use App\Models\History;
use Illuminate\Http\Request;

class HistoryController extends Controller
{
    public function history($id)
    {
        $history = History::where([
            ['task_id', '=', $id],
            ['sender_id', '!=', null]
        ])->get();

        return response([
           'message' => true,
           'history' => HistoryResource::collection($history)
        ]);
    }
}
