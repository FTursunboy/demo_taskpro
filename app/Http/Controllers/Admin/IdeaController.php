<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseController;
use App\Http\Controllers\Controller;
use App\Models\Idea;
use Illuminate\Http\Request;

class IdeaController extends BaseController
{


    public function update(Request $request, Idea $idea)
    {
        $statusId = null;
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
        $idea->comments = $request->comment;
        $idea->save();
        return redirect()->route('admin.index')->with('mess', 'Успешно обновлено!');
    }
}
