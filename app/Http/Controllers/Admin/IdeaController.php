<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseController;
use App\Http\Controllers\Controller;
use App\Models\Idea;
use Illuminate\Http\Request;

class IdeaController extends BaseController
{
    public function index() {
        $ideas = Idea::get();

        return view('admin.ideas.index', compact('ideas'));
    }

    public function show(Idea $idea){
        return view('admin.ideas.show', compact('idea'));
    }

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
                $statusId = 8;
                break;
            default:
                return back()->with('mess', 'Что-то пошло не так');
        }

        $idea->status_id = $statusId;
        $idea->comments = $request->comment;
        $idea->save();
        return redirect()->route('admin.ideas')->with('mess', 'Успешно обновлено!');
    }
}
