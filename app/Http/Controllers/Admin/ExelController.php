<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseController;
use App\Http\Controllers\Controller;
use App\Models\Admin\TaskModel;
use App\Models\Client\Offer;
use App\Models\Report;
use Box\Spout\Common\Type;
use Box\Spout\Writer\Common\Creator\WriterEntityFactory;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ExelController extends BaseController
{
    public function index() {

        $tasks = TaskModel::all();
        $offers = Offer::get();

        $fileName = uniqid();
        $storagePath = "report/{$fileName}.xlsx";

        $writer = WriterEntityFactory::createWriter(Type::XLSX);
        $writer->openToFile(storage_path("app/public/{$storagePath}"));

        // First Sheet
        $headerRow = WriterEntityFactory::createRowFromArray(['#', 'Имя', 'Время (в часах)', 'От', 'До', 'Проект', 'Автор', 'Тип', 'kpi', 'Процент', 'Статус', 'Coтрудник']);
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
                $task->type == null ? 'От клиента' : ($task->type?->name ?? ''),
                $task->typeType?->name == null ? '' : $task->typeType?->name,
                $task->percent,
                $task->status?->name,
                $task->user?->name . ' ' . $task->user?->surname
            ]);

            $writer->addRow($rowData);
        }


        $writer->addNewSheetAndMakeItCurrent();


        $secondSheetHeaderRow = WriterEntityFactory::createRowFromArray(['#', 'Название задачи', 'От', 'До',  'Ответсвенный сотрудник', 'Статус', 'Клиент']);
        $writer->addRow($secondSheetHeaderRow);

        foreach ($offers as $offer) {

            $secondSheetData = WriterEntityFactory::createRowFromArray([
                $offer->id,
                $offer->name,
                ($offer->from == null) ? 'Задача еще не распределена' : $offer->from,
                ($offer->to == null) ? 'Задача еще не распределена' : $offer->to,
                ($offer->user?->name == null) ? 'Задача еще не распределена' : $offer->user?->name,
                $offer->status?->name,
                $offer->client?->name,

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
        $report->file_name = $fileName;

        $report->save();

        $path = storage_path('app/public/' . $report->file);
        $fileName = $report->file_name . '.xlsx'; // Добавляем расширение к имени файла

        $headers = [
            'Content-Type' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
            'Content-Disposition' => 'attachment; filename="' . $fileName . '"',
        ];

        return response()->download($path, $fileName, $headers);
    }

}
