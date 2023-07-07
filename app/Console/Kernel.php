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
        $schedule->command('check-balance')->hourly()->withoutOverlapping();
        $schedule->command('backup')->daily()->withoutOverlapping();
        $schedule->command('report:send')->twiceDaily(12, 18);
        $schedule->command('check-amount-user')->hourly()->withoutOverlapping();
    }

    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__.'/Commands');
        $this->load(__DIR__.'/Commands/ReportSendCommand.php');
        $this->load(__DIR__.'/Commands/DatabaseBackUp.php');


        require base_path('routes/console.php');
    }
}
