<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\TaskModel;
use App\Models\Client\Offer;
use App\Models\User;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;

class OfferController extends Controller
{
    public function index() {
       $offers = Offer::get();


       return view('admin.offers.index', compact('offers'));
    }

    public function sendUser(Request $request, Offer $offer) {
        if ($_POST['action'] === 'decline') {
            $offer->status_id = 5;
            $offer->save();
            return redirect()->route('client.offers.index')->with('update', 'Успешно отклонено');
        }
        if ($_POST['action'] == 'refresh') {
            $offer->update([
                'user_id' => $request->user_id,
                'status_id' => 1
            ]);
            return redirect()->route('client.offers.index')->with('mess', 'Успешно отправлено');
        }
        if ($_POST['action'] == 'accept') {
            $data = $request->validate([
                'user_id' => 'required',
                'from' => 'required',
                'to' => 'required',
                'time' => 'required',
            ]);

            $offer->update([
               'from' => $data['from'],
               'to' => $data['from'],
               'time' => $data['time'],
               'user_id' => $data['user_id']
            ]);

            TaskModel::create([
                'name' => $offer->name,
                'user_id' => $data['user_id'],
                'from' => $data['from'],
                'to' => $data['to'],
                'time' => $data['time'],
                'offer_id' => $offer->id,
                'file' => $offer->file,
                'file_name' => $offer->file_name,
                'author_id' => Auth::id(),
                'client_id' => $offer->client_id,
                'comment' => $offer->description,
                'status_id' => 1,

            ]);

            return redirect()->route('client.offers.index')->with('mess', 'Успешно отправлено');
        }

    }

    public function sendClient(Offer $offer) {
        $offer->is_finished = true;
        $offer->save();
        return redirect()->back()->with('mess', 'Успешно удалено');
    }


    public function show(Offer $offer) {
        $users = User::role('user')->get();

        return view('admin.offers.show', compact('offer', 'users'));
    }


    public function delete(Offer $offer){
        $task = TaskModel::where('offer_id', $offer->id)->first();

        $task?->delete();
        $offer->delete();

        return redirect()->back()->with('mess', 'Успешно удалено');
    }


    public function update(Request $request, Offer $offer) {
        $request->validate([
            'from' => 'required',
            'to' => 'required',
            'user_id' => 'requried'
        ]);

        $offer->update([
            'from' => $request->from,
            'to' => $request->to,
            'user_id' => $request->user_id
        ]);

        return redirect()->route('client.offers.index')->with('mess', 'Успешно отправлено');
    }

}
