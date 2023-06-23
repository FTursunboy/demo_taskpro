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
use Illuminate\Support\Facades\DB;
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

        $user = User::role('client')
            ->leftJoin('offers', 'users.id', '=', 'offers.client_id')
            ->leftJoin('project_clients as pc', 'pc.user_id', 'users.id')
            ->leftJoin('project_models as p', 'p.id', 'pc.project_id')
            ->select('p.name as project', 'users.name')
            ->where([
                ['offers.client_id', Auth::id()]
            ])
            ->first();
        try {
            Notification::send(User::role('admin')->first(), new TelegramClientTask($this->name, $this->user, $user->project));
        } catch (\Exception $exception) {

        }
    }
}
