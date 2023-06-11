<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\CreateMuCommandTaskRequest;
use App\Models\Admin\TaskModel;
use App\Models\Admin\TaskTypeModel;
use App\Models\Admin\TaskTypesTypeModel;
use App\Models\Types;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use function MongoDB\BSON\fromJSON;

class MyCommandController extends Controller
{
    public function index()
    {
        $commands = new User\TeamLeadCommandModel();
        $myCommand = $commands->userInCommand(Auth::id());
        $myProject = $commands->commandProjects(Auth::id());
        $userListTasks = $commands->userTaskList(Auth::id());
        $types = TaskTypeModel::where('name', '!=', 'KPI')->get();
        return view('user.my-command.index', compact('myCommand', 'myProject', 'types', 'userListTasks'));
    }

    public function createTaskInCommand(CreateMuCommandTaskRequest $request)
    {
        $data = $request->validated();
        if ($request->file('file') !== null) {
            $file = $request->file('file')->store('public/docs');
        } else {
            $file = null;
        }
        $task = TaskModel::create([
            'name' => $data['name'],
            'time' => $data['time'],
            'type_id' => $data['type_id'],
            'from' => $data['from'],
            'to' => $data['to'],
            'comment' => $data['comment'] ?? null,
            'project_id' => $data['project_id'],
            'user_id' => $data['user_id'],
            'file' => $file ?? null,
            'file_name' => $request->file('file') ? $request->file('file')->getClientOriginalName() : null,
            'author_id' => Auth::id(),
            'status_id' => 1,
            'slug' => Str::slug($request->name . ' ' . Str::random(5)),
        ]);
        User\CreateMyCommandTaskModel::create([
            'user_id' => $data['user_id'],
            'task_id' => $task->id
        ]);
        $task->delete();
        return redirect()->route('my-command.index')->with('create', 'Задача отправлено на рассмотрение админа');
    }

    public function filter($user, $project)
    {
//        try {
//
//            $tasks = TaskModel::with(['author', 'project', 'user', 'status'])
//                ->whereIn('id', function ($query) {
//                    $query->select('tlc.user_id')
//                        ->from('team_lead_command_models AS tlc')
//                        ->where('tlc.teamLead_id', Auth::id());
//                });
//
//            if ($user !== '0' && $project === '0') {
//                $tasks = $tasks->whereIn('project_id', $project)->get();
//                dd($tasks);
//            } elseif ($user !== '0' && $project === '0') {
//                $tasks = $tasks->where('user_id', $user)->get();
//            } elseif ($user === '0' && $project !== '0') {
//                $tasks = $tasks->where('project_id', $project)->get();
//            } elseif ($user !== '0' && $project !== '0') {
//                $tasks = $tasks->where('project_id', $project)->where('user_id', $user)->get();
//            }
//            return response()->json($tasks);
//        } catch (\Exception $exception) {
//            return [
//                'error' => $exception->getMessage(),
//                'status' => false
//            ];
//        }
    }

    public function taskInQuery()
    {
        $TasksInQuery = TaskModel::withTrashed()
            ->where('author_id', Auth::id())
            ->whereNotNull('deleted_at')
            ->get();
        return view('user.my-command.task-in-query', compact('TasksInQuery'));
    }

    public function taskInQueryDelete($slug)
    {
        $task = TaskModel::withTrashed()->where('slug', $slug)->first();
        $copy = User\CreateMyCommandTaskModel::where([
            ['user_id', $task->user_id],
            ['task_id', $task->id]
        ])->first();
        $copy?->delete();
        $task->forceDelete();
        return back()->with('delete', 'Задача успешно удалено');
    }
}
