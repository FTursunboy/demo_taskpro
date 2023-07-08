<?php

namespace App\Console\Commands;

use App\Models\Setting;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class checkAmountUser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'check-amount-user';

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
        $account = User::find(1)->account;

        $response = Http::get("http://www.billng.fingroup.tj/billing/public/api/check_user/$account");

        $max = $response->json('max');
        $setting = Setting::first();
        $setting->max_users = $max;

        $setting->save();

    }
}
