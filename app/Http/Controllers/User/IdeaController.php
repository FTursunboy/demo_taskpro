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
        $data = $request->validated();
        $data['user_id'] = Auth::id();
        $data['status_id'] = 1;
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
        ]);
        $data['user_id'] = Auth::id();
        $data['status_id'] = 1;
        $data['slug'] = Str::slug($data['title'], '-', '5');

        $idea->update($data);

        return redirect()->route('user.index')->with('create', 'Идея успешна обновлена!');
    }

    public function destroy(Idea $idea)
    {
        $idea->delete();
        return redirect()->route('user.index')->with('delete','Идея успешна удалена!');
    }

}
