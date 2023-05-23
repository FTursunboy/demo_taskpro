<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\HistoryController;
use App\Models\Admin\ProjectModel;
use App\Models\Admin\TaskModel;
use App\Models\Client\Offer;
use App\Models\History;
use App\Models\ProjectClient;
use App\Models\Statuses;
use App\Models\User;
use App\Notifications\Telegram\SendNewTaskInUser;
use GuzzleHttp\Client;
use Illuminate\Console\View\Components\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Notification;

class OfferController extends BaseController
{
    public function index()
    {
        $offers = DB::table('offers as of')
            ->leftJoin('users as u', 'u.id', 'of.user_id')
            ->leftJoin('project_clients as pc', 'pc.user_id', 'of.client_id')
            ->leftJoin('project_models as p', 'p.id', 'pc.project_id')
            ->leftJoin('statuses_models as status', 'status.id', 'of.status_id')
            ->select('of.*', 'p.name as project_name', 'status.id as status', 'status.name as status_name', 'u.name as username')
            ->get();



        return view('admin.offers.index', compact('offers'));
    }

    public function sendUser(Request $request, Offer $offer)
    {
        if ($_POST['action'] === 'decline') {
            $offer->status_id = 11;
            $offer->save();

            HistoryController::client($offer->id, Auth::id(), $offer->client_id, Statuses::DECLINED);

            return redirect()->route('client.offers.index')->with('update', 'Успешно отклонено!');
        }
        if ($_POST['action'] == 'refresh') {
            $offer->update([
                'user_id' => $request->user_id,
                'status_id' => 11
            ]);
            return redirect()->route('client.offers.index')->with('mess', 'Успешно отправлено!');
        }
        if ($_POST['action'] == 'accept') {
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
                'slug' => $offer->slug,
            ]);

            HistoryController::task($task->id, $task->user_id, Statuses::CREATE);

            try {
                Notification::send(User::find($task->user_id), new SendNewTaskInUser($task->id, $task->name, $task->time, $task->from, $task->to, $task->to, 'От клиента'));
            } catch (\Exception $exception) {
            }
        }
        return redirect()->route('client.offers.index')->with('mess', 'Успешно отправлено!');

    }

    public  function sendClient(Offer $offer)
    {
        $offer->is_finished = true;
        $offer->status_id = 10;
        $offer->save();

        HistoryController::client($offer->id, Auth::id(), $offer->client_id, Statuses::SEND_TO_TEST);

        return redirect()->back()->with('mess', 'Успешно удалено!');
    }



    public function show(Offer $offer) {

        $project = ProjectClient::where('user_id', $offer->client_id)->first();



        $users = User::role('user')->get();

        $histories = History::where([
            ['type', '=', 'offer'],
            ['task_id', '=', $offer->id]
        ])->get();

        return view('admin.offers.show', compact('offer', 'users', 'project', 'histories'));
    }


    public  function delete(Offer $offer)
    {
        $task = TaskModel::where('offer_id', $offer->id)->first();
        HistoryController::client($offer->id, Auth::id(), $offer->client_id, Statuses::DELETE);

        $task?->delete();
        $offer->delete();

        return redirect()->back()->with('mess', 'Успешно удалено!');
    }


    public function update(Request $request, Offer $offer)
    {

        $request->validate([
            'from' => 'required',
            'to' => 'required',
            'user_id' => 'required'

        ]);

        $offer->update([
            'from' => $request->from,
            'to' => $request->to,
            'user_id' => $request->user_id,
            'status_id' => 9
        ]);

        HistoryController::client($offer->id, Auth::id(), $offer->client_id, Statuses::UPDATE);

        return redirect()->route('client.offers.index')->with('mess', 'Успешно отправлено!');
    }

    public function sendBack(Offer $offer){
        $offer->status_id = 9;
        $task = TaskModel::where('offer_id', $offer->id)->first();
        $task->status_id = 9;
        $offer->save();
        $task->save();
        HistoryController::client($offer->id, Auth::id(), $offer->client_id, Statuses::SEND_USER);

        return redirect()->route('client.offers.index')->with('mess', 'Успешно отправлено!');
    }

    public function edit(Offer $offer ) {

        $users = User::role('user')->get();
        return view('admin.offers.edit', compact('offer', 'users'));
    }

}
