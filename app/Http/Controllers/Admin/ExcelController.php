<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Mail\MailController;
use App\Models\Admin\EmailModel;
use App\Models\Admin\TaskModel;
use App\Models\Report;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Box\Spout\Writer\Common\Creator\WriterEntityFactory;
use Box\Spout\Common\Entity\Row;
use Box\Spout\Common\Type;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

class ExcelController extends BaseController
{

    public function index() {
        $tasks = TaskModel::all();

        $fileName = uniqid();
        $storagePath = "report/{$fileName}.xlsx";

        $writer = WriterEntityFactory::createWriter(Type::XLSX);
        $writer->openToFile(storage_path("app/public/{$storagePath}"));

        $headerRow = WriterEntityFactory::createRowFromArray(['#', 'Имя', 'Время (в часах)', 'От', 'До', 'Проект', 'Автор', 'Тип', 'Статус', 'Coтрудник']);
        $writer->addRow($headerRow);

        foreach ($tasks as $task) {
            $rowData = WriterEntityFactory::createRowFromArray([$task->id, $task->name, $task->time, $task->from, $task->to, $task->project?->name, $task->author?->name, ($task->type == null) ? 'От клиента' : $task->type?->name, $task->status?->name, $task->user?->name . " " . $task->user?->surname]);
            $writer->addRow($rowData);
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


    }
}
