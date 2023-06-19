<?php

namespace App\Jobs;

use App\Mail\ChatEmail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class ChatSendEmailClientJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $taskName;
    private $message;
    private $email;

    /**
     * Create a new job instance.
     */
    public function __construct($taskName, $message, $email)
    {

        $this->taskName = $taskName;
        $this->message = $message;
        $this->email = $email;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        Mail::to($this->email)->send(new ChatEmail($this->taskName, $this->message));
    }
}
