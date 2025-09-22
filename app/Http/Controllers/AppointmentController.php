<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use Illuminate\Http\Request;

class AppointmentController extends Controller
{

    public function index()
    {
        $appointments = Appointment::included()
            ->filter()
            ->getOrPaginate();

        return response()->json($appointments);
    }

    public function show($id)
    {
        $appointment = Appointment::included()->findOrFail($id);

        return response()->json($appointment);
    }

    
}
