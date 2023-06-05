<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\HistoryController;
use App\Models\Admin\MessagesModel;
use App\Models\Admin\ProjectModel;
use App\Models\Admin\TaskModel;
use App\Models\Admin\TaskTypeModel;
use App\Models\Admin\TaskTypesTypeModel;
use App\Models\Admin\UserTaskHistoryModel;
use App\Models\ChatMessageModel;
use App\Models\Client\Offer;
use App\Models\History;
use App\Models\Statuses;
use App\Models\User;
use App\Notifications\Telegram\SendNewTaskInUser;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Role;
use function GuzzleHttp\Promise\all;

class   TasksController extends BaseController
{
    public function index()
    {
        $users = User::role('user')->get();
        $tasks = TaskModel::orderBy('created_at', 'desc')->get();
        return view('admin.tasks.index', compact('tasks', 'users'));
    }

    public function create()
    {
        $types = TaskTypeModel::get();
        $projects = ProjectModel::get();
        $users = User::role('user')->get();

        return view('admin.tasks.create', compact('types', 'projects', 'users'));
    }

    public function show(TaskModel $task)
    {
        $messages = MessagesModel::where('task_slug', $task->slug)
            ->orWhere([
                ['user_id', Auth::id()],
                ['sender_id', Auth::id()]
            ])->get();

        $histories = History::where([
            ['task_id', '=', $task->id],
            ['type', '=', 'task']
        ])->get();




        return view('admin.tasks.show', compact('task', 'messages', 'histories'));
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
        $messages_models = MessagesModel::create([
            'task_slug' => $task->slug,
            'sender_id' => Auth::id(),
            'user_id' => $task->user_id,
            'message' => $request->message,
        ]);


//      $messages =  $messages_models->join('users as u', 'u.id', 'messages_models.user_id')
//          ->select('u.name', 'messages_models.message')
//          ->get();

        return response([
            'messages' => $messages_models,
            'name' => $messages_models->sender->name,
            'created_at' => date('d.m.Y H:i:s', strtotime($messages_models->created_at))
        ]);
    }




    public function store(Request $request)
    {

        $request->validate([
            'file' => 'nullable|file|max:1000',
        ]);

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
        Artisan::call('update:task-status');
        $type = TaskTypeModel::find($request->type_id)->name;
        try {
            Notification::send(User::find($task->user_id), new SendNewTaskInUser($task->id, $task->name, $task->time, $task->from, $task->finish, $project->to, $type));
        } catch (\Exception $exception) {

        }

        HistoryController::task($task->id, $task->user_id, Statuses::CREATE);
        return redirect()->route('tasks.index')->with('create', 'Задача успешно создана!');
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
        $projects = ProjectModel::get();
        $users = User::role('user')->get();
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
            'slug' => Str::slug($request->name . ' ' . Str::random(5)),
        ]);

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
        Artisan::call('update:task-status');
        $type = TaskTypeModel::find($request->type_id)?->name;
        try {
            Notification::send(User::find($task->user_id), new SendNewTaskInUser($task->id, $task->name, $task->time, $task->from, $task->finish, $project->to, $type));
        } catch (\Exception $exception) {

        }

        HistoryController::task($task->id, $task->user_id, Statuses::UPDATE);
        return redirect()->route('tasks.index')->with('update', 'Задача успешно обновлена');
    }

    public function sendBack(Request $request, TaskModel $task)
    {
        UserTaskHistoryModel::where('task_id', $task->id)->first()->forceDelete();


        $task->update([
            'status_id' => 1,
            'user_id' => $request->user_id,
        ]);

        HistoryController::task($task->id, $task->user_id, Statuses::RESEND);

        try {
            Notification::send(User::find($task->user_id), new SendNewTaskInUser($task->id, $task->name, $task->time, $task->from, $task->finish, $task->to, $task->type?->name));
        } catch (\Exception $exception) {

        }

        return redirect()->route('tasks.index')->with('update', 'Задача успешно перенаправлена');
    }

    public function sendBack1(Request $request, TaskModel $task)
    {
        $u = UserTaskHistoryModel::where('task_id', $task->id)->first();
        if ($u) {
            $u->forceDelete();
        }

        if($request->employee == 0){
            $task->update(
                [
                    'status_id' => 3,
                    'finish' => Carbon::now(),
                ]
            );
            return redirect()->back();
        }else {
            $task->update([
                'status_id' => 1,
                'user_id' => $request->employee,
            ]);
        }
        HistoryController::task($task->id, $task->user_id, Statuses::RESEND);

        try {
            Notification::send(User::find($task->user_id), new SendNewTaskInUser($task->id, $task->name, $task->time, $task->from, $task->finish, $task->to, $task->type?->name));
        } catch (\Exception $exception) {

        }

        return redirect()->route('tasks.index')->with('update', 'Задача успешно перенаправлена');
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

        return redirect()->route('tasks.index')->with('create', 'Задача готова!');
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
}
