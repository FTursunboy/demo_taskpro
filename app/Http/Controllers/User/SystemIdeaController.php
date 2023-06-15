<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\IdeaRequest;
use App\Http\Requests\User\SystemIdeaStoreRequest;
use App\Models\Idea;
use App\Models\SystemIdea;
use App\Models\User;
use App\Notifications\Telegram\TelegramSendClientIdead;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Str;

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

        try {
            Notification::send(User::find(1), new TelegramSendClientIdead($request->name, $request->description));
        }
        catch (\Exception $exception) {

        }

        return redirect()->route('user.index')->with('create', 'Системная идея успешно отправлена!');
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

        return redirect()->route('user.index')->with('create', 'Системная идея успешна обновлена!');
    }

    public function destroy(SystemIdea $idea)
    {
        $idea->delete();
        return redirect()->route('user.index')->with('delete','Системная идея успешна удалена!');
    }
}
