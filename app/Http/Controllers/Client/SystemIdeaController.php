<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\SystemIdeaStoreRequest;
use App\Models\SystemIdea;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SystemIdeaController extends Controller
{
    public function store(SystemIdeaStoreRequest $request)
    {
        if ($request->file('file') !== null) {
            $file = $request->file('file')->store('public/docs');
        } else {
            $file = null;
        }
        $data = $request->validated();
        $data['user_id'] = Auth::id();
        $data['status_id'] = 1;
        $data['file'] = $file ?? null;
        $data['file_name'] = $request->file('file') ? $request->file('file')->getClientOriginalName() : null;
        SystemIdea::create($data);
        return redirect()->route('client.index')->with('mess', 'Системная идея успешно отправлена!');
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

    public function update(SystemIdea $idea, Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'description' => 'required',
        ]);
        $data['user_id'] = Auth::id();
        $data['status_id'] = 1;

        $idea->update($data);

        return redirect()->route('client.index')->with('create', 'Системная идея успешна обновлена!');
    }

    public function destroy(SystemIdea $idea)
    {
        $idea->delete();
        return redirect()->route('client.index')->with('delete','Системная идея успешна удалена!');
    }
}
