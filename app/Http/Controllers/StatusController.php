<?php

namespace App\Http\Controllers;

use App\Models\Status;
use Illuminate\Http\Request;

class StatusController extends Controller
{
    public function index()
    {
        $status = Status::included()
            ->filter()
            ->getOrPaginate();

        return response()->json($status);
    }
    public function show($id)
    {
        $status = Status::included()->findOrFail($id);

        return response()->json($status);
    }
}
