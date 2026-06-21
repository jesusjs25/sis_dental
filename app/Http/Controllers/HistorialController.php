<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Paciente;
use App\Models\Event;

class HistorialController extends Controller
{
    public function index()
    {
       $pacientes = Paciente::all(); 
    return view('admin.historiales.index', compact('pacientes'));
    }

    public function ver_reservas($id)
    {
        $eventos = Event::where('user_id', $id)->get();
        return view('admin.historiales.ver_reservas', compact('eventos'));
    }
}