<?php

namespace App\Http\Controllers;

use App\Models\Pago;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PagoController extends Controller
{
    public function index() {
       $pagos = Pago::all();
        return view('admin.pagos.index', compact('pagos')); 
    }

// Función para obtener la tasa (puedes usar una API externa aquí luego)
    public function getTasaBCV() {
        // Por ahora retornamos una fija, pero aquí iría tu lógica de scraping o API
        return 36.50; 
    }

    public function store(Request $request)
    {
        $request->validate([
            'referencia' => 'required|unique:pagos',
            'monto_usd' => 'required_without:monto_bs',
            'comprobante' => 'image|mailable|max:2048'
        ]);

        $tasa = $this->getTasaBCV();
        
        $pago = new Pago();
        $pago->user_id = auth()->id();
        $pago->metodo = $request->metodo;
        $pago->tasa_cambio = $tasa;
        
        // Lógica multimoneda
        if($request->filled('monto_usd')){
            $pago->monto_usd = $request->monto_usd;
            $pago->monto_bs = $request->monto_usd * $tasa;
        } else {
            $pago->monto_bs = $request->monto_bs;
            $pago->monto_usd = $request->monto_bs / $tasa;
        }

        $pago->referencia = $request->referencia;

        if ($request->hasFile('comprobante')) {
            $pago->comprobante = $request->file('comprobante')->store('comprobantes', 'public');
        }

        $pago->save();

        return redirect()->back()->with('success', 'Pago registrado. Esperando aprobación del administrador.');
    }

    // Botón para el Administrador
    public function aprobar($id)
    {
        $pago = Pago::findOrFail($id);
        $pago->status = 'confirmado';
        $pago->save();

        // Aquí dispararemos luego la generación de la factura PDF
        return redirect()->back()->with('info', 'Pago aprobado y factura generada.');
    }
}