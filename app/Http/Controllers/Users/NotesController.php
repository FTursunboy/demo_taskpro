<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\BaseController;
use App\Http\Controllers\Controller;
use App\Models\Users\NotesModels;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotesController extends BaseController
{
    public function store(Request $request)
    {
        NotesModels::create([
            'note' => $request->note,
            'user_id' => Auth::id(),
        ]);
        return back()->with('create', 'Заметка создана!');
    }

    public function update(NotesModels $note, Request $request)
    {
        $note->update([
            'note' => $request->note
        ]);
        return back()->with('update', 'Заметка обновлена!');
    }

    public function destroy(NotesModels $note)
    {
        $note->delete();
        return back()->with('delete', 'Заметка удалена!');
    }
}
