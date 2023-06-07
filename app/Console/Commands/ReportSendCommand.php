<?php

namespace App\Console\Commands;

use App\Models\Admin\EmailModel;
use App\Models\Admin\TaskModel;
use App\Models\Client\Offer;
use App\Models\Report;
use Box\Spout\Common\Type;
use Box\Spout\Writer\Common\Creator\WriterEntityFactory;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

class ReportSendCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'report:send';

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
        $tasks = TaskModel::all();
        $offers = Offer::get();

        $fileName = uniqid();
        $storagePath = "report/{$fileName}.xlsx";

        $writer = WriterEntityFactory::createWriter(Type::XLSX);
        $writer->openToFile(storage_path("app/public/{$storagePath}"));

// First Sheet
        $headerRow = WriterEntityFactory::createRowFromArray(['#', 'Имя', 'Время (в часах)', 'От', 'До', 'Проект', 'Автор', 'Тип', 'Статус', 'Coтрудник']);
        $writer->addRow($headerRow);

        foreach ($tasks as $task) {
            $rowData = WriterEntityFactory::createRowFromArray([
                $task->id,
                $task->name,
                $task->time,
                $task->from,
                $task->to,
                $task->project?->name,
                $task->author?->name,
                ($task->type == null) ? 'От клиента' : ($task->type?->name ?? '') . ' ' . (($task->typeType?->name == null) ? '' : '--' . $task->typeType?->name) . ' ' . $task->percent,
                $task->status?->name,
                $task->user?->name . ' ' . $task->user?->surname
            ]);

            $writer->addRow($rowData);
        }


        $writer->addNewSheetAndMakeItCurrent(); // Add a new sheet and make it the active sheet


        $secondSheetHeaderRow = WriterEntityFactory::createRowFromArray(['Column 1', 'Column 2', 'Column 3']);
        $writer->addRow($secondSheetHeaderRow);

        foreach ($offers as $offer) {

            $secondSheetData = WriterEntityFactory::createRowFromArray([

            ]);
            $writer->addRow($secondSheetData);
        }
        $writer->close();

        $currentDate = Carbon::now()->format('Y-m-d');
        $fileNameWithDate = 'Отчет по ' . $currentDate;

        $storageFilePath = Storage::disk('public')->put($storagePath, file_get_contents(storage_path("app/public/{$storagePath}")));

        storage_path("app/public/{$storagePath}");

        $report = new Report();
        $report->name = $fileNameWithDate;
        $report->file = $storagePath;

        $report->save();

        $files = storage_path('app/public/' . $report->file);
        $email = EmailModel::first()->email;
        Mail::send([], [], function ($message) use ($files, $email) {
            $message->to($email)
                ->subject('Отчет')
                ->attach($files, ['as' => 'Отчет_этого_дня.xlsx', 'mime' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet']);
        });


        $this->info('Отчет отправлен.');
    }
}
