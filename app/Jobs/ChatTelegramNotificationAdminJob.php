<?php

namespace App\Jobs;

use App\Models\Admin\MessagesModel;
use App\Models\User;
use App\Notifications\Telegram\Chat;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Notification;

class ChatTelegramNotificationAdminJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private MessagesModel $messagesModel;
    private $task_name;
    private $task_id;

    /**
     * Create a new job instance.
     */
    public function __construct($messagesModel, $task_name, $task_id)
    {
        //
        $this->messagesModel = $messagesModel;
        $this->task_name = $task_name;
        $this->task_id = $task_id;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        Notification::send(User::find(1), new Chat($this->messagesModel, $this->task_name, $this->task_id));
    }
}
