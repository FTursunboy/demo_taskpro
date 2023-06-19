<?php

namespace App\Jobs;

use App\Http\Controllers\HistoryController;
use App\Models\Client\Offer;
use App\Models\ClientNotification;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class NewOfferStoreJobMake implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public $data;
    public ?string $file;
    public ?string $filename;
    public $client_id;

    /**
     * Create a new job instance.
     */
    public function __construct($data, $file, $filename, $client_id)
    {
        $this->data = $data;
        $this->file = $file;
        $this->filename = $filename;
        $this->client_id = $client_id;
    }

    /**
     * Execute the job.
     */







    public function handle(): Offer
    {
        $request = $this->data;

        $name = $request['name'] ?? null;
        $description = $request['description'] ?? null;
        $authorName = $request['author_name'] ?? null;
        $authorPhone = $request['author_phone'] ?? null;
        $slug = Str::slug($name . ' ' . Str::random(5), '-');

        $offer = Offer::create([
            'name' => $name,
            'description' => $description,
            'author_name' => $authorName,
            'author_phone' => $authorPhone,
            'file' => $this->file,
            'file_name' => $this->filename,
            'status_id' => 8,
            'client_id' => $this->client_id,
            'slug' => $slug,
        ]);

        $offer_test =  Offer::where([
            'name' => $name,
            'description' => $description,
        ])->first();
        HistoryController::client($offer_test->id, Auth::id(), Auth::id(), 2);
        return $offer;
    }
}
