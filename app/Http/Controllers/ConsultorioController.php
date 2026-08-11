<?php

namespace App\Http\Controllers;

use App\Models\Consultorio;
use Illuminate\Http\Request;

class ConsultorioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $consultorio = Consultorio::all();
        return view('admin.consultorios.index', compact('consultorio'));
    }

    // 📱 Método para retornar los consultorios en formato JSON para la App Móvil
    public function indexApi()
    {
        // Obtenemos todos los registros de los consultorios
        $consultorios = Consultorio::all();
        
        // Respondemos con los datos en formato JSON puro
        return response()->json($consultorios, 200);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.consultorios.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //$datos = request()->all();
        //return response()->json($datos);

        $request->validate([
            'nombre' => 'required',
            'ubicacion' => 'required',
            'capacidad' => 'required|integer',
            'especialidad' => 'required',
            'estado' => 'required',
        ]);

        Consultorio::create($request->all());

        return redirect()->route('admin.consultorios.index')
        ->with('mensaje', 'El consultorio se ha creado correctamente.')
        ->with('icono', 'success');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $consultorio = Consultorio::findOrFail($id);
        return view('admin.consultorios.show',compact ('consultorio'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $consultorio = Consultorio::findOrFail($id);
        return view('admin.consultorios.edit',compact ('consultorio'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nombre' => 'required',
            'ubicacion' => 'required',
            'capacidad' => 'required|integer',
            'especialidad' => 'required',
            'estado' => 'required',
        ]);

        $consultorio = Consultorio::find($id);
        $consultorio->update($request->all());

        return redirect()->route('admin.consultorios.index')
        ->with('mensaje', 'El consultorio se ha actualizado correctamente.')
        ->with('icono', 'success');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function confirmDelete($id){

            $consultorio = Consultorio::findOrFail($id);
        return view('admin.consultorios.delete',compact ('consultorio'));
    }
    public function destroy($id)
    {
        $consultorio = Consultorio::find($id);
        $consultorio->delete();

        return redirect()->route('admin.consultorios.index')
        ->with('mensaje', 'El consultorio se ha eliminado correctamente.')
        ->with('icono', 'success');
    }
}
