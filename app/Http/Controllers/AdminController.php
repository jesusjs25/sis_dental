<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Paciente;
use App\Models\Consultorio;
use App\Models\Doctor;
use App\Models\Horario;
use App\Models\Event;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        $total_usuarios = User::count();
        $total_pacientes = Paciente::count();
        $total_consultorios = Consultorio::count();
        $total_doctores = Doctor::count();
        $total_horarios = Horario::count();

        $consultorios = Consultorio::all();
        $doctores = Doctor::all();
        $eventos = Event::all();

        return view('admin.index',compact(
            'total_usuarios',
            'total_pacientes',
            'total_consultorios',
            'total_doctores',
            'total_horarios',
            'consultorios',
            'doctores',
            'eventos',
        ));
    }
}
