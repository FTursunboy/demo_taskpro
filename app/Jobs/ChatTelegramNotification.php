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

class ChatTelegramNotification implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

   protected MessagesModel $messagesModel;
   protected $offer_name;
   protected $offer_id;
    private $user_id;

    /**
     * Create a new job instance.
     */
    public function __construct($messagesModel, $offer_name, $offer_id, $user_id)
    {
        $this->messagesModel = $messagesModel;
        $this->offer_name = $offer_name;
        $this->offer_id = $offer_id;
        $this->user_id = $user_id;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        try {
            Notification::send(User::find(1), new Chat($this->messagesModel, $this->offer_name, $this->offer_id));
            Notification::send(User::find($this->user_id), new Chat($this->messagesModel, $this->offer_name, $this->offer_id));
        } catch (\Exception $exception) {

        }
    }
}
