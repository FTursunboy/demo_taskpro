<?php

namespace App\Http\Controllers\API\V1\Tasks;

use App\Http\Controllers\Controller;
use App\Http\Controllers\HistoryController;
use App\Http\Resources\API\V1\Tasks\OffersResource;
use App\Http\Resources\API\V1\TypeResource;
use App\Http\Resources\API\V1\UserResource;
use App\Models\Admin\ProjectModel;
use App\Models\Admin\TaskModel;
use App\Models\Admin\TaskTypeModel;
use App\Models\Client\Offer;
use App\Models\ProjectClient;
use App\Models\Statuses;
use App\Models\User;
use App\Notifications\Telegram\SendNewTaskInUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Notification;

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

    public function index_filter()
    {
        $offers = DB::table('offers as of')
            ->leftJoin('users as u', 'u.id', 'of.user_id')
            ->leftJoin('users as client', 'client.id', 'of.client_id')
            ->leftJoin('project_clients as pc', 'pc.user_id', 'of.client_id')
            ->leftJoin('project_models as p', 'p.id', 'pc.project_id')
            ->leftJoin('statuses_models as status', 'status.id', 'of.status_id')
            ->whereNull('of.deleted_at')
            ->where('status_id', 8)
            ->select('of.*', 'p.name as project_name', 'status.id as status', 'status.name as status_name', 'u.name as username', 'client.name as client_name')
            ->orderBy('of.created_at', 'desc')
            ->get();

        return response([
            'message' => true,
            'task_client' =>$offers // OffersResource::collection($offers)
        ]);
    }

    public function create()
    {
        return response([
           'message' => true,
           'users' => UserResource::collection(User::role('user')->get()),
           'types' => TypeResource::collection(TaskTypeModel::all())
        ]);
    }

    public function sendUser(Request $request, $id)
    {
        $offer = Offer::find($id);

            $data = $request->validate([
                'user_id' => 'required',
                'from' => 'required',
                'to' => 'required',
                'time' => '',
            ]);

            $offer->update([
                'from' => $data['from'],
                'to' => $data['from'],
                'time' => $data['time'],
                'user_id' => $data['user_id'],
                'status_id' => 9
            ]);

            HistoryController::client($offer->id, Auth::id(), $offer->client_id, Statuses::ACCEPT);
            HistoryController::client($offer->id, Auth::id(), $offer->client_id, Statuses::SEND_USER);

            $project_id = ProjectClient::where('user_id', $offer->client_id)->first()->project_id;


            $task = TaskModel::create([
                'name' => $offer->name,
                'user_id' => $data['user_id'],
                'from' => $data['from'],
                'to' => $data['to'],
                'time' => $data['time'],
                'offer_id' => $offer->id,
                'file' => $offer->file,
                'file_name' => $offer->file_name,
                'author_id' => $offer->client_id,
                'client_id' => $offer->client_id,
                'comment' => $offer->description,
                'project_id' => $project_id,
                'status_id' => 9,
                'type_id' => $request->type_id,
                'percent' => $request->percent,
                'kpi_id' => $request->kpi_id ?: null,
                'slug' => $offer->slug,
            ]);

            HistoryController::task($task->id, $task->user_id, Statuses::CREATE);

            try {
                Notification::send(User::find($task->user_id), new SendNewTaskInUser($task->id, $task->name, $task->time, $task->from, $task->to, $task->to, 'От клиента'));
            } catch (\Exception $exception) {
            }

        return [
            'message' => true
        ];

    }
}
