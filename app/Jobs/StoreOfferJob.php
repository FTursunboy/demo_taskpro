<?php

namespace App\Jobs;

use App\Http\Controllers\HistoryController;
use App\Models\Admin\EmailModel;
use App\Models\Client\Offer;
use App\Models\ClientNotification;
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
use Illuminate\Support\Str;

class StoreOfferJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $data;
    protected ?string $file;
    protected ?string $filename;
    private $client_id;

    /**
     * Create a new job instance.
     */
    public function __construct($data, $file, $filename, $client_id)
    {
        $this->data = $data;
        $this->file = $file;
        $this->filename = $filename;
        $this->clent_id = $client_id;
    }

    /**
     * Execute the job.
     */
    public function handle(): Void
    {

        $request = $this->data;

        $offer = Offer::create([
            'name' => $request['name'],
            'description' => $request['description'],
            'author_name' => $request['author_name'],
            'author_phone' => $request['author_phone'],
            'file' => $this->file,
            'file_name' => $this->filename,
            'status_id' => 8,
            'client_id' => $this->client_id,
            'slug' => Str::slug($request['name'] . ' ' . Str::random(5), '-'),
        ]);


        ClientNotification::create([
            'offer_id' => $offer->id
        ]);




    }
}
