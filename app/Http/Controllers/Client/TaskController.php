<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\BaseController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\HistoryController;
use App\Http\Controllers\Mail\MailController;
use App\Http\Requests\Client\TaskRequest;
use App\Mail\Send;
use App\Models\Admin\EmailModel;
use App\Models\Admin\MessagesModel;
use App\Models\Admin\TaskModel;
use App\Models\Client\Offer;

use App\Models\ClientNotification;
use App\Models\History;
use App\Models\Statuses;
use App\Models\User;

use App\Notifications\Telegram\TelegramClientTask;
use App\Notifications\Telegram\TelegramUserAccept;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class TaskController extends BaseController
{
    public function index()
    {
        $tasks = Offer::where([
            ['client_id', '=', Auth::id()],
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
            $file = $request->file('file')->store('public/docs');
            //            $file = Storage::disk('public')->put('/docs', $upload_file);
        } else {
            $file = null;
            $file_name = null;
        }

        $offer = Offer::create([
            'name' => $request->name,
            'description' => ($request->description === null)? null:$request->description,
            'author_name' => $request->author_name,
            'author_phone' => $request->author_phone,
            'file' => $file,
            'file_name' => $file_name,
            'status_id' => 8,
            'client_id' => Auth::id(),
            'slug' => Str::slug($request->name . ' ' . Str::random(5), '-'),
        ]);

        ClientNotification::create([
            'offer_id' => $offer->id
        ]);

        $mail = EmailModel::first()->email;

        $name = Auth::user()->name;

        Mail::to($mail)->send(new Send($name));

        $user = User::role('admin')->first();

        HistoryController::client($offer->id, Auth::id(), Auth::id(), 2);

        try {
            Notification::send(User::role('admin')->first(), new TelegramClientTask($offer->name, Auth::user()->name));
        } catch (\Exception $exception) {
        }

        return redirect()->route('offers.index')->with('create', 'Успешно создано!');

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
//            $file = Storage::disk('public')->put('public/docs', $upload_file);
            $file = $request->file('file')->store('public/docs');
            $offer->file = $file;
            $offer->file_name = $file_name;
        }

        $offer->name = $request->name;
        $offer->description = $request->description;
        $offer->author_name = $request->author_name;
        $offer->author_phone = $request->author_phone;
        $offer->client_id = Auth::id();

        $offer->save();

        HistoryController::client($offer->id, Auth::id(), Auth::id(), 8);
        return redirect()->route('offers.index')->with('update', 'Успешно обновлено!');
    }

    public function delete(Offer $offer)
    {
        $offer->delete();
        $user = User::role('admin')->first();
        HistoryController::client($offer->id, Auth::id(), Auth::id(), 9);
        return redirect()->back()->with('mess', 'Успешно удалено!');
    }

    public function confirm(Offer $offer)
    {
        $offer->status_id = 3;
        $offer->finish = Carbon::now();
        $tasks = TaskModel::where('offer_id', $offer->id)->first();
        if ($tasks !== null) {
            $tasks->status_id = 3;
            $tasks->save();
        }
        $offer->save();
        $user = User::role('admin')->first();
        HistoryController::client($offer->id, Auth::id(), Auth::id(), 5);
        return redirect()->back()->with('mess', 'Успешно отправлено!');
    }

    public function decline(Offer $offer)
    {
        $offer->status_id = 13;
        $offer->is_finished = false;
        $offer->save();
        $tasks = TaskModel::where('offer_id', $offer->id)->first();
        if ($tasks !== null) {
            $tasks->status_id = 13;
            $tasks->save();
        }
        $user = User::role('admin')->first();
        HistoryController::client($offer->id, Auth::id(), Auth::id(), Statuses::DECLINED);
        return redirect()->back()->with('mess', 'Успешно отправлено!');
    }

    public function downloadFile(Offer $offer)
    {
        $path = storage_path('app/' . $offer->file);

        $headers = [
            'Content-Type' => 'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
            'Content-Disposition' => 'attachment; filename="' . $offer->file_name . '"',
        ];

        return response()->download($path, $offer->file_name, $headers);
    }


    public function download_file_chat(MessagesModel $messagesModel)  {
        $path = storage_path('app/public/' . $messagesModel->file);

        $headers = [
            'Content-Type' => 'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
            'Content-Disposition' => 'attachment; filename="' . $messagesModel->file_name . '"',
        ];

        return response()->download($path, $messagesModel->file_name, $headers);

    }

    public function ready(Offer $offer)
    {
        $offer->status_id = 3;
        $user = User::find($offer->user_id);
        $user->xp += 20;
        $user->save();
        $offer->finish = Carbon::now();
        $offer->save();

        $tasks = TaskModel::where('offer_id', $offer->id)->first();
        if ($tasks !== null) {
            $tasks->status_id = 3;
            $tasks->save();
        }

        $user = User::role('admin')->first();
        HistoryController::client($offer->id, Auth::id(), Auth::id(), 5);

        return redirect()->back()->with('create', 'Задача успешно завершена!');
    }
}
