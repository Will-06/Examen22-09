<?php

namespace App\Http\Controllers;

use App\Models\Plan;
use Illuminate\Http\Request;

class PlanController extends Controller
{

    public function index()
    {
        $plans = Plan::included()
            ->filter()
            ->getOrPaginate();

        return response()->json($plans);
    }

    public function show($id)
    {
        $plan = Plan::included()->findOrFail($id);

        return response()->json($plan);
    }

    public function store()
    {
   

        
    }
}
