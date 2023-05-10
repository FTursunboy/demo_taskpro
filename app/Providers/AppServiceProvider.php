<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        config([
            'constants.CREATE' => 1,
            'constants.SEND' => 2,
            'constants.DECLINED' => 3,
            'constants.FINISH' => 4,
            'constants.CONFIRM' => 5,
            'constants.OUT_OF_DATE' => 6,
            'constants.SEND_TO_TEST' => 7,
            'constants.UPDATE' => 8,
            'constants.DELETE' => 9,
            'constants.RESEND' => 10,
        ]);
    }


    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
