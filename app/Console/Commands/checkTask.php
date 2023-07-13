<?php

namespace App\Console\Commands;

use App\Models\Admin\TaskModel;
use App\Models\CheckDate;
use Carbon\Carbon;
use Illuminate\Console\Command;

class checkTask extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'check-task';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
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

                    $check = CheckDate::where('task_id', $task->id)->first();
                    $date = Carbon::now();

                    $deadLine = $check->deadline;
                    $minus = Carbon::create($deadLine);

                    $result = $date->diff($minus);

                    $check->count = $result->format('%a');
                    $check->save();
                }
            }
        }

    }
}
