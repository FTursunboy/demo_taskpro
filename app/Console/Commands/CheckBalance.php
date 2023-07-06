<?php

namespace App\Console\Commands;

use App\Models\Setting;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class CheckBalance extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'check-balance';

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

        $user = User::find(23);

        $response = Http::get("http://www.billng.fingroup.tj/billing/public/api/checkBalance/$user->account");
        $settings = Setting::first();

        if ($response->json()['message'] === true){
            $settings->has_access = true;
        }else{
            $settings->has_access = false;
        }

        $settings->save();


    }
}
