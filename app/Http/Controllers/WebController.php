<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Horario;
use App\Models\Consultorio;
use App\Models\Doctor;

class WebController extends Controller
{
    public function index() {
        /*try {

            $horarios = Horario::with('doctor','consultorio')->where('consultorio_id', $id)->get();
            //print_r($horarios);
            return view('admin.horarios.cargar_datos_consultorios', compact('horarios'));

        }catch(\Exception $exception) {
            return reponse()->json(['mensaje' => 'Error']);
        }*/

        $consultorios = Consultorio::all();
        return view ('index',compact('consultorios'));
    }
}
