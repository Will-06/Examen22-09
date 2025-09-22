<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    
    public function index()
    {
        $services = Service::included()
            ->filter()
            ->getOrPaginate();

        return response()->json($services);
    }

    public function show($id)
    {
        $service = Service::included()->findOrFail($id);

        return response()->json($service);
    }
}
