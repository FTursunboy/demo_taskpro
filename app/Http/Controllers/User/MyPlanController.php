<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\BaseController;
use App\Http\Controllers\Controller;
use App\Models\User\MyPlanModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MyPlanController extends BaseController
{
    public function index()
    {
        $myPlan = MyPlanModel::where('user_id', Auth::id())->get();
        return view('user.plan.index', compact('myPlan'));
    }
}
