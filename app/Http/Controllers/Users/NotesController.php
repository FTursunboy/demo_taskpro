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
        return redirect()->route('user.index')->with('create', 'Заметка создана!');
    }

    public function update(NotesModels $note, Request $request)
    {
        $note->update([
            'note' => $request->note
        ]);
        return redirect()->route('user.index')->with('update', 'Заметка обновлена!');
    }

    public function destroy(NotesModels $note)
    {
        $note->delete();
        return redirect()->route('user.index')->with('delete', 'Заметка удалена!');
    }
}
