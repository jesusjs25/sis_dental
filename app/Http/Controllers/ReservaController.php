<?php

namespace App\Http\Controllers;

use App\Models\Reserva;
use App\Models\Paciente;
use Illuminate\Http\Request;

class ReservaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function verificar(Request $request)
    {
        //$datos = request()->all();
        //return response()->json($datos);

        // 1. Buscar si el paciente existe por identificación
        $paciente = Paciente::where('identificacion', $request->identificacion)->first();

        if (!$paciente) {
            return back()->with('error_paciente', 'El documento no existe. Debe registrarse para continuar.');
        }

        // 2. Verificar si la fecha y hora ya están ocupadas
        $citaExistente = Reserva::where('fecha', $request->fecha)
                             ->where('hora', $request->hora)
                             ->first();

        if ($citaExistente) {
            return back()->with('error_disponibilidad', 'La fecha y hora seleccionada no está disponible. Por favor, elija otra.');
        }

        // 3. Si todo es correcto, crear la reserva
    Appointment::create([
        'paciente_id' => $paciente->id,
        'fecha' => $request->fecha,
        'hora' => $request->hora,
    ]);

    return back()->with('success', '¡Reserva realizada con éxito!');
    }



    public function index()
    {
        return view('admin.reservas.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //$datos = request()->all();
        //return response()->json($datos);
    }

    /**
     * Display the specified resource.
     */
    public function show(Reserva $reserva)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Reserva $reserva)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Reserva $reserva)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Reserva $reserva)
    {
        //
    }
}
