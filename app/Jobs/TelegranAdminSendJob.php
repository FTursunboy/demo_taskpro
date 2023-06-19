<?php

namespace App\Jobs;

use App\Models\User;
use App\Notifications\Telegram\TelegramClientTask;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;

class TelegranAdminSendJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $name;
    private $user;

    /**
     * Create a new job instance.
     */
    public function __construct($name, $user)
    {
        $this->name = $name;
        $this->user = $user;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        try {
            Notification::send(User::role('admin')->first(), new TelegramClientTask($this->name, $this->user));
        } catch (\Exception $exception) {

        }
    }
}
