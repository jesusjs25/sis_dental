<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Paciente;

class HistorialController extends Controller
{
    public function index()
    {
       $pacientes = Paciente::all(); 
    return view('admin.historiales.index', compact('pacientes'));
    }
}