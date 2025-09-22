<?php

namespace App\Http\Controllers;

use App\Models\Customization;
use Illuminate\Http\Request;

class CustomizationController extends Controller
{
    public function index()
    {
        $customizations = Customization::included()
            ->filter()
            ->getOrPaginate();

        return response()->json($customizations);
    }

    public function show($id)
    {
        $customization = Customization::included()->findOrFail($id);

        return response()->json($customization);
    }
}
