<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
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
                return back()->with('mess', 'Что-то пошло не так');
        }

        $idea->status_id = $statusId;
        $idea->comment = $request->comment;
        $idea->save();
        return redirect()->route('admin.index')->with('mess', 'Успешно обновлено!');
    }
}
