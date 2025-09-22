<?php

namespace App\Http\Controllers;

use App\Models\Business;
use Illuminate\Http\Request;

class BusinessController extends Controller
{

    public function index()
    {
        $businesses = Business::included()
            ->filter()
            ->getOrPaginate();

        return response()->json($businesses);
    }


    public function show($id)
    {
        $business = Business::included()->findOrFail($id);

        return response()->json($business);
    }
}
