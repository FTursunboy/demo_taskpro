<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Idea;
use App\Models\SystemIdea;
use Illuminate\Http\Request;

class SystemIdeaController extends Controller
{
    public function update(Request $request, SystemIdea $idea)
    {
        switch ($request->input('action')) {
            case 'accept':
                $statusId = 4;
                break;
            case 'decline':
                $statusId = 5;
                break;
            case 'update':
                $statusId = 15;
                break;
            default:
                return back()->with('create', 'Что-то пошло не так');
        }

        $idea->status_id = $statusId;
        $idea->comment = $request->comment;
        $idea->save();
        return redirect()->route('admin.index')->with('create', 'Успешно обновлено!');
    }

    public function downloadFile(SystemIdea $idea)
    {
        $path = storage_path('app/' . $idea->file);
        $headers = [
            'Content-Type' => 'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
            'Content-Disposition' => 'attachment; filename="' . $idea->file_name . '"',
        ];

        return response()->download($path, $idea->file_name, $headers);
    }

    public function delete(SystemIdea $idea) {
        $idea->delete();
        return redirect()->back()->with('mess', 'Успешно удалено');
    }
}
