<?php

namespace App\Http\Controllers;

use App\Models\Pago;
use App\Models\Paciente;
use App\Models\Configuracion;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class PagoController extends Controller
{
    public function index() {
    $pagos = Pago::with('paciente')->orderBy('created_at', 'desc')->get();
    
    // Buscamos la tasa guardada o usamos una por defecto (0) si es la primera vez
    $tasa_config = Configuracion::where('clave', 'tasa_dia')->first();
    $tasa_actual = $tasa_config ? $tasa_config->valor : 0;

    return view('admin.pagos.index', compact('pagos', 'tasa_actual')); 
}

public function guardarTasa(Request $request) {
    // Actualiza o crea la tasa en la base de datos
    Configuracion::updateOrCreate(
        ['clave' => 'tasa_dia'],
        ['valor' => $request->tasa_dia]
    );
    return back()->with('success', 'Tasa del día actualizada correctamente.');
}

    public function buscarPaciente(Request $request) {
    // Buscamos en el modelo Paciente
    $paciente = Paciente::where('identificacion', $request->identificacion)->first();
    
    if ($paciente) {
        return response()->json([
            'exists' => true,
            'nombres' => $paciente->nombres . ' ' . $paciente->apellidos
        ]);
    }

    return response()->json(['exists' => false]);
}

    public function store(Request $request) {
        // 1. Validamos que el paciente exista en la tabla 'pacientes'
    $paciente = Paciente::where('identificacion', $request->identificacion)->first();

    if (!$paciente) {
        return back()->with('error', 'El paciente no existe. Por favor, regístrelo antes de procesar el pago.')
                     ->withInput(); // Mantiene los datos escritos para que no los pierdas
    }

        // 2. Crear el pago asociado
        $pago = new Pago();
        $pago->paciente_id = $paciente->id; 
        $pago->monto_usd = $request->monto_usd;
        $pago->tasa_dia = $request->tasa_dia;
        $pago->monto_bs = $request->monto_usd * $request->tasa_dia;
        $pago->metodo_pago = $request->metodo_pago;
        $pago->numero_operacion = $request->numero_operacion;
        $pago->vuelto_usd = ($request->recibido_usd ?? 0) - $request->monto_usd;
        $pago->save();

        return back()->with('success', 'Pago vinculado al historial de ' . $paciente->nombres);
    }

    public function descargarPDF($id) {
        $pago = Pago::findOrFail($id);
        $pdf = Pdf::loadView('pagos.recibo_pdf', compact('pago'));
        return $pdf->stream('recibo_odoncere_'.$pago->id.'.pdf');
    }
}