<?php

namespace App\Jobs;

use App\Models\User;
use App\Notifications\Telegram\Chat;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Notification;

class ChatUserNotificationJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $user_id;
    private $messages;
    private $task_name;
    private $task_id;

    /**
     * Create a new job instance.
     */
    public function __construct($user_id, $messages, $task_name, $task_id)
    {
        //
        $this->user_id = $user_id;
        $this->messages = $messages;
        $this->task_name = $task_name;
        $this->task_id = $task_id;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        Notification::send(User::find($this->user_id), new Chat($this->messages, $this->task_name, $this->task_id));
    }
}
