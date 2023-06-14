<?php

namespace App\Console\Commands;

use App\Models\Admin\EmailModel;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class DatabaseBackUp extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'backup:db';

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
        $timestamp = Carbon::now()->format('Y-m-d_H-i-s');
        $filename = "backup_" . $timestamp . '.sql';

        $command = "mysqldump --user=" . env('DB_USERNAME') .
            " --password=" . env('DB_PASSWORD') .
            " --host=" . env('DB_HOST') ." ". env('DB_DATABASE'). " > " .
            storage_path('app/public/backup/') . $filename;

        exec($command);

        $files = storage_path('app/public/backup/' . $filename);
        $email = EmailModel::first()->email;
        Mail::send([], [], function ($message) use ($files, $email) {

            $message->to('tfaiziev04@gmail.com')
                ->subject('Backup')
                ->attach($files, ['as' => 'Backup.sql', 'mime' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet']);
        });




    }
}
