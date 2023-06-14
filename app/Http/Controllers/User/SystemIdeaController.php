<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\IdeaRequest;
use App\Http\Requests\User\SystemIdeaStoreRequest;
use App\Models\Idea;
use App\Models\SystemIdea;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class SystemIdeaController extends Controller
{
    public function store(SystemIdeaStoreRequest $request)
    {
        $data = $request->validated();
        $data['user_id'] = Auth::id();
        $data['status_id'] = 1;
        SystemIdea::create($data);
        return redirect()->route('user.index')->with('mess', 'Системная идея успешно отправлена!');
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
