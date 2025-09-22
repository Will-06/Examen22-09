<?php

namespace App\Http\Controllers;

use App\Models\Agenda;
use Illuminate\Http\Request;

class AgendaController extends Controller
{

    public function index()
    {
        $agendas = Agenda::included()
            ->filter()
            ->getOrPaginate();

        return response()->json($agendas);
    }

    public function show($id)
    {
        $agenda = Agenda::included()->findOrFail($id);

        return response()->json($agenda);
    }
    public function store()
    {
   

        
    }
}
