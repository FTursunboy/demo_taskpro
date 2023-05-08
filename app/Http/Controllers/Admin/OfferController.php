<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Client\Offer;
use App\Models\SuperAdmin\TasksTeamLeadModels;
use App\Models\User;
use App\Notifications\Telegram;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;

class OfferController extends Controller
{
    public function index() {
       $offers = Offer::where('status_id', '<>', '3')->get();
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
                'name' => 'required',
                'description' => 'required',
                'user_id' => 'required',
                'from' => 'required',
                'to' => 'required',
            ]);

            $offer->update([
                'user_id' => $data['user_id'],
                'description' => $data['description'],
                'from' => $data['from'],
                'to' => $data['to'],
                'status_id' => 1
            ]);

            return redirect()->route('client.offers.index')->with('mess', 'Успешно отправлено');
        }

    }

    public function sendClient(Offer $offer) {
        $offer->is_finished = true;
        $offer->save();
    }
}
