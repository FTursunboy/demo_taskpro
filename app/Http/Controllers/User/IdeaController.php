<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\IdeaRequest;
use App\Models\Idea;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class IdeaController extends Controller
{
    public function index(){
        $ideas = Idea::where('user_id', Auth::user()->id)->get();

        return view('user.idea.index', compact('ideas'));
    }

    public function store(IdeaRequest $request) {
        $data = $request->validated();
        $data['user_id'] = Auth::id();
        $data['status_id'] = 1;
        $data['slug'] = Str::slug($data['title'], '-', '5');
        Idea::create($data);

        return redirect()->route('user.ideas')->with('mess', 'Успешно отправлено');
    }

    public function create(){
        return view('user.idea.create');
    }

    public function show(Idea $idea) {

        return view('user.idea.show', compact('idea'));
    }


    public function edit(Idea $idea){
        return view('user.idea.edit', compact('idea'));
    }

    public function update(Idea $idea, Request $request) {
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

        return redirect()->route('user.ideas')->with('mess', 'Успешно обновлена');
    }


}
