<?php

namespace App\Http\Controllers\API\V1\Tasks;

use App\Http\Controllers\Controller;
use App\Http\Resources\API\V1\Tasks\OffersResource;
use App\Http\Resources\API\V1\UserResource;
use App\Models\Admin\ProjectModel;
use App\Models\Statuses;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TaskClient extends Controller
{
    public function index()
    {
        $offers = DB::table('offers as of')
            ->leftJoin('users as u', 'u.id', 'of.user_id')
            ->leftJoin('users as client', 'client.id', 'of.client_id')
            ->leftJoin('project_clients as pc', 'pc.user_id', 'of.client_id')
            ->leftJoin('project_models as p', 'p.id', 'pc.project_id')
            ->leftJoin('statuses_models as status', 'status.id', 'of.status_id')
            ->whereNull('of.deleted_at')
            ->select('of.*', 'p.name as project_name', 'status.id as status', 'status.name as status_name', 'u.name as username', 'client.name as client_name')
            ->orderBy('of.created_at', 'desc')
            ->get();

        return response([
            'message' => true,
            'task_client' =>$offers // OffersResource::collection($offers)
        ]);
    }
}
