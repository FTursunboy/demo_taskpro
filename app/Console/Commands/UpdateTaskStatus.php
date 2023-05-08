<?php

namespace App\Console\Commands;

use App\Models\Admin\TaskModel;
use Illuminate\Console\Command;

class UpdateTaskStatus extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'update:task-status';

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
        $tasks = TaskModel::where('to', '<=', now()->addWeek())
            ->where('status_id', '=', 2)
            ->where('status_id', '=', 4)
            ->where('status_id', '=', 6)
            ->get();
        foreach ($tasks as $task) {
            $task->status_id = 7;
            $task->save();
        }
    }
}
