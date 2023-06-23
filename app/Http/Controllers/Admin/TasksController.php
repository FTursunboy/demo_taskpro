<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\HistoryController;
use App\Http\Controllers\Mail\MailToSendClientController;
use App\Http\Controllers\ReportHistoryController;
use App\Jobs\ChatSendEmailClientJob;
use App\Jobs\ChatUserNotificationJob;
use App\Mail\ChatEmail;
use App\Mail\OfferReady;
use App\Mail\Send;
use App\Models\Admin\MessagesModel;
use App\Models\Admin\ProjectModel;
use App\Models\Admin\TaskModel;
use App\Models\Admin\TaskTypeModel;
use App\Models\Admin\TaskTypesTypeModel;
use App\Models\Admin\UserTaskHistoryModel;
use App\Models\ChatMessageModel;
use App\Models\CheckDate;
use App\Models\Client\Offer;
use App\Models\History;
use App\Models\ReportHistory;
use App\Models\Statuses;
use App\Models\User;
use App\Notifications\Telegram\Chat;
use App\Notifications\Telegram\SendNewTaskInUser;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class  TasksController extends BaseController
{
    public function index()
    {
        $users = User::role(['user', 'admin'])->get();
        $tasks = TaskModel::orderBy('created_at', 'desc')->where('status_id', '!=', 3)->get();
        $this->check();
        return view('admin.tasks.index', compact('tasks', 'users'));
    }

    public function check()
    {

        $tasks = TaskModel::orderBy('created_at', 'desc')->get();
        foreach ($tasks as $task) {
            if ($task->to < now()->toDateString()) {
                if ($task->status_id !== 1 && $task->status_id !== 3 && $task->status_id !== 5 && $task->status_id !== 6 && $task->status_id !== 10 && $task->status_id !== 11 && $task->status_id !== 12 && $task->status_id !== 13) {
                    $task->status_id = 7;
                    $task->save();

                    CheckDate::updateOrCreate(
                        ['task_id' => $task->id],
                        [
                            'deadline' => $task->to,
                            'task_id' => $task->id,
                        ]);
                    $history = History::where([
                        ['task_id', $task->id],
                        ['status_id', 7],
                        ['user_id', 35]
                    ])->first();

                    $offer = Offer::where('id', $task->id)->first();
                    if ($offer !== null) {

                        $history_offer = History::where([
                            ['task_id', $offer->id],
                            ['status_id', 7],
                            ['user_id', 35],
                        ])->first();

                        if ($history_offer == null) {
                            HistoryController::out_of_date_offer($offer->id);
                        }
                    }

                    if ($history == null) {
                        HistoryController::out_of_date($task->id);
                    }
                    $check = CheckDate::where('task_id', $task->id)->first();
                    $date = Carbon::now();
                    $current_date = $date->format('Y-m-d');
                    $deadLine = $check->deadline;
                    $minus = Carbon::create($deadLine);

                    $result = $date->diff($minus);

                    $check->count = $result->format('%a');
                    $check->save();

                }
            }
        }

        return $tasks;
    }

    public function create()
    {
        $types = TaskTypeModel::get();
        $projects = ProjectModel::where('pro_status', '!=', 3)->get();
        $users = User::role(['user', 'admin'])->get();

        return view('admin.tasks.create', compact('types', 'projects', 'users'));
    }

    public function show(TaskModel $task)
    {
        $messages = MessagesModel::where('task_slug', $task->slug)->get();

        $histories = History::where([
            ['task_id', '=', $task->id],
            ['type', '=', 'offer']
        ])->get();

        $users = User::role('user')->get();

        return view('admin.tasks.show', compact('task', 'messages', 'histories', 'users'));
    }

    public function removeNotification(TaskModel $task)
    {
        $mess = ChatMessageModel::where('task_id', $task->id)->first();
        $mess?->delete();
        if ($task->offer_id !== null) {
            return redirect()->route('offers.chat', $task->offer_id);
        }
        return redirect()->route('tasks.show', $task->id);
    }

    public function file_show($file)
    {
        if (Storage::disk('public')->exists($file)) {
            $filePath = Storage::disk('public')->path($file);
        }
        return redirect()->file($filePath);
    }

    public function message(TaskModel $task, Request $request)
    {
        $data = $request->validate([
            'message' => 'required',
        ]);

        if ($request->file('file') !== null) {
            $file = $request->file('file')->store('public/chat_docs');
        } else {
            $file = null;
        }

        $messages_models = MessagesModel::create([
            'task_slug' => $task->slug,
            'sender_id' => Auth::id(),
            'user_id' => $task->user_id,
            'message' => $request->message,
            'file' => $file ?? null,
            'file_name' => $request->file('file') ? $request->file('file')->getClientOriginalName() : null,
        ]);

        $user = User::find($task->client_id);
        $email = $user?->clientEmail?->email;

        ChatUserNotificationJob::dispatch($task->user_id, $messages_models, $task->name, $task->id);
        if ($email !== null) {
            ChatSendEmailClientJob::dispatch($task->name, $messages_models->message, $email);
        }

        return response([
            'messages' => $messages_models,
            'name' => $messages_models->sender->name,
            'created_at' => date('d.m.Y H:i:s', strtotime($messages_models->created_at))
        ]);
    }

    public function message_offer(Offer $offer, Request $request)
    {
        $data = $request->validate([
            'message' => 'required',
        ]);

        if ($request->file('file') !== null) {
            $file = $request->file('file')->store('public/chat_docs');
        } else {
            $file = null;
        }

        $messages_models = MessagesModel::create([
            'task_slug' => $offer->slug,
            'sender_id' => Auth::id(),
            'user_id' => $offer->user_id,
            'message' => $request->message,
            'file' => $file ?? null,
            'file_name' => $request->file('file') ? $request->file('file')->getClientOriginalName() : null,
        ]);
        $task = TaskModel::where('offer_id', $offer->id)->first();

        try {
            Notification::send(User::find($offer->user_id), new Chat($messages_models, $offer->name, ($task) ? $task->id : $offer->id));
            $user = User::find($offer->client_id);
            $email = $user?->clientEmail?->email;

            Mail::to($email)->send(new ChatEmail($offer->name, $request->message));
        } catch (\Exception $exception) {

        }

        return response([
            'messages' => $messages_models,
            'name' => $messages_models->sender->name,
            'created_at' => date('d.m.Y H:i:s', strtotime($messages_models->created_at))
        ]);
    }


    public function store(Request $request)
    {
        if ($request->file('file') !== null) {
            $file = $request->file('file')->store('public/docs');
        } else {
            $file = null;
        }

        $task = TaskModel::create([
            'name' => $request->name,
            'time' => $request->time,
            'from' => $request->from,
            'to' => $request->to,
            'comment' => $request->comment ?? null,
            'file' => $file ?? null,
            'file_name' => $request->file('file') ? $request->file('file')->getClientOriginalName() : null,
            'project_id' => $request->project_id,
            'type_id' => $request->type_id,
            'percent' => $request->percent,
            'kpi_id' => $request->kpi_id ?: null,
            'user_id' => $request->user_id,
            'author_id' => Auth::id(),
            'status_id' => 1,
            'client_id' => $request->client_id ?? null,
            'cancel' => $request->cancel ?? null,
            'cancel_admin' => $request->cancel_admin ?? null,
            'slug' => Str::slug($request->name . ' ' . Str::random(5)),
        ]);
        $project = ProjectModel::where('id', $request->project_id)->first();
        $project->update([
            'pro_status' => 2,
        ]);

        if ($request->user_id == Auth::id()) {
            $task->update([
                'status_id' => 2,
            ]);
        }

        $this->check();
        $type = TaskTypeModel::find($request->type_id)->name;
        try {
            Notification::send(User::find($task->user_id), new SendNewTaskInUser($task->id, $task->name, $task->time, $task->from, $task->to, $project->finish, $type));
        } catch (\Exception $exception) {

        }

        HistoryController::task($task->id, $task->user_id, Statuses::CREATE);
        return redirect()->back()->with('mess', 'Задача успешно создана!');
    }

    public function downloadFile(TaskModel $task)
    {
        $path = storage_path('app/' . $task->file);
        $headers = [
            'Content-Type' => 'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
            'Content-Disposition' => 'attachment; filename="' . $task->file_name . '"',
        ];

        return response()->download($path, $task->file_name, $headers);
    }


    public function edit(TaskModel $task)
    {
        $types = TaskTypeModel::get();
        $projects = ProjectModel::where('pro_status', '!=', 3)->get();
        $users = User::role(['user', 'admin'])->get();
        $type_kpi = TaskTypesTypeModel::get();
        return view('admin.tasks.edit', compact('types', 'projects', 'users', 'task', 'type_kpi'));
    }

    public function update(Request $request, TaskModel $task)
    {
        $file = $task->file;

        if ($request->hasFile('file')) {
            $newFile = $request->file('file')->store('public/docs/');
            if ($newFile !== $file) {
                if ($file !== null) {
                    Storage::delete($file);
                }
                $file = $newFile;
            }
        }


        $task->update([
            'name' => $request->name,
            'time' => $request->time,
            'from' => $request->from,
            'to' => $request->to,
            'comment' => $request->comment ?? null,
            'file' => $file ?? null,
            'file_name' => $request->file('file') ? $request->file('file')->getClientOriginalName() : null,
            'project_id' => $request->project_id,
            'type_id' => $request->type_id,
            'percent' => $request->percent,
            'kpi_id' => $request->kpi_id ?: null,
            'user_id' => $request->user_id,
            'author_id' => Auth::id(),
            'status_id' => 1,
            'client_id' => $request->client_id ?? null,
            'cancel' => $request->cancel ?? null,
            'cancel_admin' => $request->cancel_admin ?? null,
        ]);

        if ($request->user_id == Auth::id()) {
            $task->update([
                'status_id' => 2,
            ]);

        }

        if ($request->type_id != 2) {
            $task->update([
                'percent' => null,
                'kpi_id' => null,
            ]);
        }

        $project = ProjectModel::where('id', $request->project_id)->first();
        $project->update([
            'pro_status' => 2,
        ]);

        $type = TaskTypeModel::find($request->type_id)?->name;
        try {
            Notification::send(User::find($task->user_id), new SendNewTaskInUser($task->id, $task->name, $task->time, $task->from, $task->finish, $project->to, $type));
        } catch (\Exception $exception) {

        }

        HistoryController::task($task->id, $task->user_id, Statuses::UPDATE);

        $task1 = new TasksController();

        $task1->check();
        return redirect()->route('mon.index')->with('update', 'Задача успешно обновлена');
    }

    public function sendBack(Request $request, TaskModel $task)
    {
        $taskHistory = UserTaskHistoryModel::where('task_id', $task->id)->first();

        if ($taskHistory) {
            $taskHistory->delete();
        }

        $task->update([
            'status_id' => 1,
            'user_id' => $request->user_id,
        ]);

        HistoryController::task($task->id, $task->user_id, Statuses::RESEND);

        try {
            Notification::send(User::find($task->user_id), new SendNewTaskInUser($task->id, $task->name, $task->time, $task->from, $task->finish, $task->to, $task->type?->name));
        } catch (\Exception $exception) {

        }

        return redirect()->route('mon.index')->with('mess', 'Задача успешно перенаправлена');
    }

    public function sendBack1(Request $request, TaskModel $task)
    {
        $u = UserTaskHistoryModel::where('task_id', $task->id)->first();
        if ($u) {
            $u->delete();
        }

        if ($request->employee == null) {
            $task->update(
                [
                    'status_id' => 3,
                    'finish' => Carbon::now(),
                ]
            );

            try {
                $user = User::find($task->client_id);
                $email = $user->clientEmail->email;
                $taskName = $task->name;
                MailToSendClientController::send($email, $taskName);
            } catch (\Exception $exception) {

            }


            $offer = Offer::find($task->offer_id);

            if ($offer !== null) {

                $offer->status_id = 10;
                $offer->save();
                $task->status_id = 10;
                $task->save();
                HistoryController::client($offer->id, Auth::id(), $offer->client_id, Statuses::SEND_TO_TEST);
                HistoryController::task($task->id, $task->user_id, Statuses::FINISH);

                return redirect()->back()->with('mess', 'Успешно отправлено');
            } else {

                $user = User::where('id', $task->user_id)->first();
                $user->xp += 20;
                $user->save();
                HistoryController::task($task->id, $task->user_id, Statuses::FINISH);
                $task->finish = Carbon::now();
                $task1 = $task->id;
                $task->save();

                return redirect()->back()->with(['mess' => 'Успешно завершено', 'task1' => $task1]);
            }


        } else {
            ReportHistoryController::create(
                $task->slug,
                Statuses::RESEND,
                $request->input('reason')
            );

            $user = User::where('id', $request->employee)->first();
            if ($user->position === 'Admin') {
                $task->update([
                    'status_id' => 2,
                    'user_id' => $request->employee,
                ]);
            } else {
                $task->update([
                    'status_id' => 1,
                    'user_id' => $request->employee,
                ]);
                HistoryController::task($task->id, $task->user_id, Statuses::RESEND);
            }
        }


        try {
            Notification::send(User::find($task->user_id), new SendNewTaskInUser($task->id, $task->name, $task->time, $task->from, $task->finish, $task->to, $task->type?->name));
        } catch (\Exception $exception) {

        }

        return redirect()->back()->with('mess', 'Успешно отправлено');
    }


    public function ready(TaskModel $task)
    {

        UserTaskHistoryModel::create([
            'user_id' => $task->user_id,
            'task_id' => $task->id,
            'status_id' => 3,
        ]);
        $task->update([
            'status_id' => 3,
            'finish' => Carbon::now(),
        ]);

        HistoryController::task($task->id, $task->user_id, Statuses::FINISH);

        if ($task->client_id) {
            $offer = Offer::find($task->offer_id);

            $offer->is_finished = true;
            $offer->status_id = 10;
            $offer->save();

            HistoryController::client($offer->id, Auth::id(), $offer->client_id, Statuses::SEND_TO_TEST);
        }

        return redirect()->route('mon.index')->with('create', 'Задача готова!');
    }

    public function destroy(TaskModel $task)
    {
        $task->delete();
        HistoryController::task($task->id, $task->user_id, Statuses::DELETE);

        return back()->with('delete', 'Задача успешна удалена!');
    }

    // For Ajax query
    public function kpi($id)
    {
        return TaskTypesTypeModel::where('typeTask_id', $id)->select('id', 'name')->get();
    }

    public function delete(MessagesModel $mess)
    {
        $mess->delete();
        return redirect()->back();
    }

    public function control($user_id, $from, $to, $time)  {

        $taskModels = DB::table('task_models')
            ->where('user_id', $user_id)
            ->where(function ($query) use ($from, $to) {
                $query->whereBetween('from', [$from, $to])
                    ->orWhereBetween('to', [$from, $to]);
            })
            ->get();
        $user = User::find($user_id)->name;
        $hour = 0;

        foreach ($taskModels as $task) {
            $hour += $task->time;
        }

        $from_check = Carbon::createFromFormat('Y-m-d', $from);
        $to_check = Carbon::createFromFormat('Y-m-d', $to);
        $days = $to_check->diffInDays($from_check);

        $is_valid = false;
        $total = $days * 8 + 8;

        $allow = $total - $hour;



        if($allow > 0) {
            $is_valid = true;
        }

        if ($time > $allow) {
            $is_valid = false;
        }



        return response([
            'tasks' => $taskModels,
            'hour' => $hour,
            'total' => $total,
            'allowed' => $allow,
            'is_valid' => $is_valid,
            'time' => $time,
            'user' => $user
        ]);

    }

    public function userSendBack(TaskModel $task) {
        $task->status_id = 1;
        $offer = Offer::find($task->offer_id);
        $offer->status_id = 9;
        $offer->save();
        $task->save();

        HistoryController::client($offer->id, Auth::id(), $offer->client_id, Statuses::SEND_USER);
        $history = UserTaskHistoryModel::where('task_id', $task->id)->first();

        $history?->delete();
        return back();
    }
}
