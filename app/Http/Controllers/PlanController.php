<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Plan;

class PlanController extends Controller
{
    public function store(Request $request){  
        $plan = new Plan(request()->all());
        // dd($plan);
        $plan->save();
        return $plan->id;
    }
}
