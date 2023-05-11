<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Http\Controllers\HistoryController;
use App\Http\Controllers\Mail\MailController;
use App\Http\Requests\Client\TaskRequest;
use App\Models\Admin\EmailModel;
use App\Models\Client\Offer;

use App\Models\History;
use App\Models\User;

use App\Notifications\Telegram\TelegramClientTask;
use App\Notifications\Telegram\TelegramUserAccept;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Storage;

class TaskController extends Controller
{
    public function index()
    {
        $tasks = Offer::where([
            ['client_id', '=', Auth::id()],
            ['status_id', '<>', 6],
            ['is_finished', '=', false]
        ])->get();

        return view('client.offers.index', compact('tasks'));
    }

    public function create()
    {
        return view('client.offers.create');
    }


    public function show(Offer $offer) {


        $histories = History::where([
            ['type', '=', 'offer'],
            ['client_id', '=', Auth::id()],
            ['task_id', '=', $offer->id]

        ])->orderBy('created_at')->get();



        return view('client.offers.show', compact('offer', 'histories'));
    }

    public function store(TaskRequest $request)
    {
        $request->validated();

        if (isset($request->file)) {
            $upload_file = $request->file('file');
            $file_name = $upload_file->getClientOriginalName();
            $file = Storage::disk('public')->put('/docs', $upload_file);
        } else {
            $file = null;
            $file_name = null;
        }


        $offer = Offer::create([
            'name' => $request->name,
            'description' => $request->description,
            'author_name' => $request->author_name,
            'author_phone' => $request->author_phone,
            'file' => $file,
            'file_name' => $file_name,
            'status_id' => 8,
            'client_id' => Auth::id(),
        ]);

        $mail = new MailController();
        $mail->send(EmailModel::first()->email);

        $user = User::role('admin')->first();

        HistoryController::client($offer->id, Auth::id(), Auth::id(), 2);

        try {
            Notification::send(User::role('admin')->first(), new TelegramClientTask($offer->name, Auth::user()->name));
        } catch (\Exception $exception) {
        }

        return redirect()->route('offers.index')->with('create', 'Успешно создано');

    }

    public function edit(Offer $offer)
    {
        return view('client.offers.edit', ['offer' => $offer]);
    }

    public function update(TaskRequest $request, Offer $offer)
    {
        $request->validated();

        if (isset($request->file)) {
            $upload_file = $request->file('file');
            $file_name = $upload_file->getClientOriginalName();
            $file = Storage::disk('public')->put('/docs', $upload_file);
            $offer->file = $file;
            $offer->file_name = $file_name;
        }

        $offer->name = $request->name;
        $offer->description = $request->description;
        $offer->author_name = $request->author_name;
        $offer->author_phone = $request->author_phone;
        $offer->client_id = Auth::id();

        $offer->save();
        $user = User::role('admin')->first();
        HistoryController::client($offer->id, Auth::id(), Auth::id(), 9);
        return redirect()->route('offers.index')->with('update', 'Успешно обновлено');
    }

    public function delete(Offer $offer)
    {
        $offer->delete();
        $user = User::role('admin')->first();
        HistoryController::client($offer->id, Auth::id(), Auth::id(), 10);
        return redirect()->back()->with('mess', 'Успешно удалено');
    }

    public function confirm(Offer $offer)
    {
        $offer->status_id = 3;
        $offer->save();
        $user = User::role('admin')->first();
        HistoryController::client($offer->id, Auth::id(), Auth::id(), 6);
        return redirect()->back()->with('mess', 'Успешно отправлено');
    }

    public function decline(Offer $offer)
    {
        $offer->status_id = 1;
        $offer->save();

        $user = User::role('admin')->first();
        HistoryController::client($offer->id, Auth::id(), Auth::id(), 11);
        return redirect()->back()->with('mess', 'Успешно отправлено');
    }

    public function downloadFile(Offer $offer)
    {


        $path = storage_path('app/public/' . $offer->file);

        $headers = [
            'Content-Type' => 'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
            'Content-Disposition' => 'attachment; filename="' . $offer->file_name . '"',
        ];
        return response()->download($path, $offer->file_name, $headers);

    }

    public function ready(Offer $offer)
    {
        $offer->status_id = 3;
        $offer->save();

        $user = User::role('admin')->first();
        HistoryController::client($offer->id, Auth::id(), Auth::id(), 6);

        return redirect()->back()->with('mess', 'Успешно отправлено');
    }
}
