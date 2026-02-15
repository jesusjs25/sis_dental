<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Doctor;
use App\Models\Horario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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


        $request->validate([
            'doctor_id' => 'required|exists:doctors,id', // Verifica que el doctor exista
            'fecha_reserva'=>'required|date',
            'hora_reserva'=>'required|date_format:H:i',
        ]);

        $doctor = Doctor::findOrFail($request->doctor_id);
        $fecha_reserva = $request->fecha_reserva;
        $hora_reserva = $request->hora_reserva.':00';

        /*$dia = date('l',strtotime($fecha_reserva)); // La función date('l') devuelve el nombre del día en inglés (ejemplo: "Wednesday"). 
        // Si tu servidor tiene una configuración de idioma local (locale) diferente 
        // o si esperas que strtotime se comporte de forma automática con el idioma del sistema, puede haber discrepancias.
        $dia_de_reserva = $this->traducir_dia($dia);*/

        // Por estas para asegurar compatibilidad
        $dia_ingles = date('l', strtotime($fecha_reserva));
        $dia_de_reserva = $this->traducir_dia(ucfirst(strtolower($dia_ingles)));

        //valida si existe el horario del doctor
        $horarios = Horario::where('doctor_id',$doctor->id)
                    ->where('dia',$dia_de_reserva)
                    ->where('hora_inicio','<=',$hora_reserva)
                    ->where('hora_fin','>=',$hora_reserva)
                    ->exists();

        if(!$horarios){
            return redirect()->back()->with([
                'mensaje' => 'El doctor no esta disponible en ese horario.',
                'icono' => 'error',
                'hora_reserva'=> 'El doctor no esta disponible en ese horario.',
            ]);
        }

        $fecha_hora_reserva = $fecha_reserva." ".$hora_reserva;

        /// valida si existen eventos duplicado
        $eventos_duplicados = Event::where('doctor_id',$doctor->id)
                              ->where('start', $fecha_hora_reserva)
                              ->exists();

        if($eventos_duplicados){
            return redirect()->back()->with([
                'mensaje' => 'Ya existe una reserva con el mismo doctor en esa fecha y hora.',
                'icono' => 'error',
                'hora_reserva'=> 'Ya existe una reserva con el mismo doctor en esa fecha y hora.',
            ]);
        }


        $evento = new Event();
        $evento->title = $request->hora_reserva." ".$doctor->especialidad;
        $evento->start = $request->fecha_reserva." ".$hora_reserva;
        $evento->end = $request->fecha_reserva." ".$hora_reserva;
        $evento->color = 'green';
        $evento->user_id = Auth::user()->id;
        $evento->doctor_id  = $request->doctor_id;
        $evento->consultorio_id   = '1';
        $evento->save();

        return redirect()->route('admin.index')
            ->with('mensaje','Se registro la reserva de la cita medica la manera correcta')
            ->with('icono','success');
    }

    private function traducir_dia($dia){
        $dias=[
            'Monday' => 'LUNES',
            'Tuesday' => 'MARTES',
            'Wednesday' => 'MIERCOLES',
            'Thursday' => 'JUEVES',
            'Friday' => 'VIERNES',
            'Saturday' => 'SABADO',
            'Sunday' => 'DOMINGO',
        ];
        return $dias[$dia]??$dias;
    }

    /**
     * Display the specified resource.
     */
    public function show(Event $event)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Event $event)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Event $event)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Event $event)
    {
        //
    }

    public function verificarYReservar(Request $request) 
{
    // Validar que los campos no estén vacíos antes de procesar
    if (!$request->fecha_reserva || !$request->hora_reserva || !$request->identificacion) {
        return response()->json([
            'status' => 'error',
            'mensaje' => 'Por favor, complete todos los campos del formulario.'
        ]);
    }

    // 1. Validar existencia del paciente
    $paciente = \App\Models\Paciente::where('identificacion', $request->identificacion)->first();
    
    if (!$paciente) {
        return response()->json([
            'status' => 'error_paciente',
            'mensaje' => 'Usted no se encuentra registrado.',
            'link' => route('admin.pacientes.create')
        ]);
    }

    // 2. Formatear correctamente la fecha y hora para MySQL
    // Aseguramos el formato Y-m-d H:i:s
    $fecha_hora_inicio = $request->fecha_reserva . ' ' . $request->hora_reserva . ':00';

    // 3. Validar disponibilidad en la tabla eventos
    $existeEvento = \App\Models\Event::where('start', $fecha_hora_inicio)->exists();

    if ($existeEvento) {
        return response()->json([
            'status' => 'error_disponibilidad',
            'mensaje' => 'La fecha y hora seleccionada ya está ocupada.'
        ]);
    }

    // 4. Guardado
    try {
        $doctor = \App\Models\Doctor::first(); // Asigna un doctor por defecto o el elegido

        $evento = new \App\Models\Event();
        // Usamos el nombre del paciente real encontrado
        $evento->title = "Cita: " . $paciente->nombres . " " . $paciente->apellidos . " - " . $doctor->especialidad;
        $evento->start = $fecha_hora_inicio;
        $evento->end = $fecha_hora_inicio; 
        $evento->color = '#28a745'; 
        $evento->user_id = \Illuminate\Support\Facades\Auth::user()->id;
        $evento->doctor_id = $doctor->id;
        $evento->consultorio_id = 1; 
        $evento->save();

        return response()->json([
            'status' => 'success',
            'mensaje' => '¡Reserva realizada con éxito!'
        ]);
    } catch (\Exception $e) {
        return response()->json([
            'status' => 'error',
            'mensaje' => 'Error técnico: ' . $e->getMessage()
        ]);
    }
}
}
