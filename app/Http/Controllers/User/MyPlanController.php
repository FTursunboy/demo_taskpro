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
        $myPlan = $this->myPlan(Auth::id(), Carbon::now()->format('Y-m-d'));
        $allPlan = MyPlanModel::where('user_id', Auth::id())->orderBy('status', 'asc')
            ->orderBy('hour', 'asc')->get();
        return view('user.plan.index', compact('myPlan', 'allPlan'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required'],
            'hour' => ['required'],
            'description' => ['required']
        ]);

        MyPlanModel::create([
            'name' => $data['name'],
            'hour' => $data['hour'],
            'description' => $data['description'],
            'date' => Carbon::now()->format('Y-m-d'),
            'status' => false,
            'user_id' => Auth::id(),
        ]);

        return redirect()->route('plan.index')->with('creat', 'План успешно создан!');
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


    public function myPlan($userID, $today)
    {
        return MyPlanModel::where([
            ['user_id', $userID],
            ['date', $today],
        ])
            ->orderBy('status', 'asc')
            ->orderBy('hour', 'asc')
            ->get();

    }

    public function MyPercentPlan($userID)
    {
        $plan = $this->myPlan($userID, Carbon::now()->format('Y-m-d'));
        $percent_100 = $plan->pluck('hour')->sum();
        $success = $plan->where('status', true)->pluck('hour')->sum();
        $unSuccess = $plan->where('status', false)->pluck('hour')->sum();
        return response([
            'success' => number_format(($success * 100) / $percent_100, 2),
            'unSuccess' => number_format(($unSuccess * 100) / $percent_100, 2),
        ]);
    }
}
