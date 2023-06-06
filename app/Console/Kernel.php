<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use App\Console\Commands;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
        // $schedule->command('inspire')->hourly();
        $schedule->command('report:send')->dailyAt('12:00')->twiceDaily(18, 0);

        $schedule->command('report:send')->twiceDaily(12, 18);
    }

    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__.'/Commands');
        $this->load(__DIR__.'/Commands/ReportSendCommand.php');


        require base_path('routes/console.php');
    }
}
