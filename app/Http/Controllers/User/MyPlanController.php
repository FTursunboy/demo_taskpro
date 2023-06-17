<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\BaseController;
use App\Http\Controllers\Controller;
use App\Models\User\MyPlanModel;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class MyPlanController extends BaseController
{
    public function index()
    {
        $allPlan = MyPlanModel::where('user_id', Auth::id())->orderBy('status', 'asc')->orderBy('hour', 'asc')->get();
        return view('user.plan.index', compact( 'allPlan'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required'],
            'hour' => ['required'],
            'description' => ['required'],
            'date' => ['required'],
        ]);

        MyPlanModel::create([
            'name' => $data['name'],
            'hour' => $data['hour'],
            'description' => $data['description'],
            'date' => $data['date'],
            'status' => false,
            'user_id' => Auth::id(),
        ]);

        return redirect()->route('plan.index')->with('creat', 'План успешно создан!');
    }

    public function update(MyPlanModel $plan, Request $request)
    {
        $data = $request->validate([
            'name' => ['required'],
            'hour' => ['required'],
            'description' => ['required'],
            'date' => ['required'],
        ]);

        $plan->update([
            'name' => $data['name'],
            'hour' => $data['hour'],
            'description' => $data['description'],
            'date' => $data['date'],
        ]);
        return redirect()->route('plan.index')->with('update', 'План успешно изменен!');

    }

    public function ready(MyPlanModel $plan)
    {
        $plan->update(['status' => true]);
        return redirect()->route('plan.index')->with('create', 'План завершен!');
    }

    public function delete(MyPlanModel $plan)
    {
        $plan->delete();
        return redirect()->route('plan.index')->with('delete', 'План удалён');
    }

}
