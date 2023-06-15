<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\BaseController;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\IdeaRequest;
use App\Models\Idea;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class IdeaController extends BaseController
{
    public function store(IdeaRequest $request)
    {
        if ($request->file('file') !== null) {
            $file = $request->file('file')->store('public/idea_docs');
        } else {
            $file = null;
        }

        $data = $request->validated();
        $data['user_id'] = Auth::id();
        $data['status_id'] = 1;
        $data['file'] = $file ?? null;
        $data['file_name'] = $request->file('file') ? $request->file('file')->getClientOriginalName() : null;
        $data['slug'] = Str::slug($data['title'], '-', '5');
        Idea::create($data);
        return redirect()->route('user.index')->with('mess', 'Идея успешно отправлена!');
    }
    public function update(Idea $idea, Request $request)
    {
        $data = $request->validate([
            'title' => 'required',
            'description' => 'required',
            'budget' => 'required',
            'pluses' => 'required',
            'minuses' => 'required',
            'from' => 'required',
            'to' => 'required',
            'file' => '',
            'file_name' => '',
        ]);
        $data['user_id'] = Auth::id();
        $data['status_id'] = 1;
        $data['slug'] = Str::slug($data['title'], '-', '5');

        $idea->update($data);

        return redirect()->route('user.index')->with('create', 'Идея успешна обновлена!');
    }

    public function downloadFile(Idea $idea)
    {
        $path = storage_path('app/' . $idea->file);
        $headers = [
            'Content-Type' => 'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
            'Content-Disposition' => 'attachment; filename="' . $idea->file_name . '"',
        ];

        return response()->download($path, $idea->file_name, $headers);
    }

    public function destroy(Idea $idea)
    {
        $idea->delete();
        return redirect()->route('user.index')->with('delete','Идея успешна удалена!');
    }

}
