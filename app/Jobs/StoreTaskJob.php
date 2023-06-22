<?php

namespace App\Jobs;

use App\Models\Admin\ProjectModel;
use App\Models\Admin\TaskModel;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class StoreTaskJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $request;
    private $user;
    private $file;
    private $filename;

    /**
     * Create a new job instance.
     */
    public function __construct($request, $user, $file, $filename)
    {
        $this->request = $request;
        $this->user = $user;
        $this->file = $file;
        $this->filename = $filename;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $task = TaskModel::create([
            'name' => $this->request['name'],
            'time' => $this->request['time'],
            'from' => $this->request['from'],
            'to' => $this->request['to'],
            'comment' => $this->request['comment'] ?? null,
            'file' => $this->file ?? null,
            'file_name' => $this->filename,
            'project_id' => $this->request['project_id'],
            'type_id' => $this->request['type_id'],
            'percent' => $this->request['percent'],
            'kpi_id' => $this->request['kpi_id'] ?: null,
            'user_id' => $this->request['user_id'],
            'author_id' => $this->user,
            'status_id' => 1,
            'client_id' => $this->request['client_id'] ?? null,
            'cancel' => $this->request['cancel'] ?? null,
            'cancel_admin' => $this->request['cancel_admin'] ?? null,
            'slug' => Str::slug($this->request['name'] . ' ' . Str::random(5)),
        ]);
        $project = ProjectModel::where('id', $this->request['project_id'])->first();
        $project->update([
            'pro_status' => 2,
        ]);

        if ($this->request['user_id'] == $this->user) {
            $task->update([
                'status_id' => 2,
            ]);
        }
    }
}
