<?php

namespace App\Http\Controllers;

use App\Models\Paciente;
use Illuminate\Http\Request;

class PacienteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pacientes = Paciente::all();
        return view('admin.pacientes.index', compact('pacientes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.pacientes.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //$datos = request()->all();
        //return response()->json($datos);

        $request->validate([
            'tipo_identificacion' => 'required|max:255',
            'identificacion' => 'required|max:255|unique:pacientes',
            'nombres' => 'required|max:255',
            'apellidos' => 'required|max:255',
            'correo_electronico' => 'required|email|unique:pacientes',
            'f_nacimiento' => 'required|',
            'edad' => 'required|',
            'direccion' => 'required|max:255',
            'telefono' => 'required|max:255',
        ]);

        $pacientes = new Paciente();
        $pacientes->tipo_identificacion = $request->tipo_identificacion;
        $pacientes->identificacion = $request->identificacion;
        $pacientes->nombres = $request->nombres;
        $pacientes->apellidos = $request->apellidos;
        $pacientes->correo_electronico = $request->correo_electronico;
        $pacientes->f_nacimiento = $request->f_nacimiento;
        $pacientes->edad = $request->edad;
        $pacientes->direccion = $request->direccion;
        $pacientes->telefono = $request->telefono;
        $pacientes->save();

        return redirect()->route('admin.pacientes.index')
        ->with('mensaje', 'El paciente se ha creado correctamente.')
        ->with('icono', 'success');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $pacientes = Paciente::findOrFail($id);
        return view('admin.pacientes.show', compact('pacientes'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $pacientes = Paciente::find($id);
        return view('admin.pacientes.edit', compact('pacientes'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        //$datos = request()->all();
        //return response()->json($datos);

        $request->validate([
            'tipo_identificacion' => 'required|max:255',
            'identificacion' => 'required|max:255|unique:pacientes',
            'nombres' => 'required|max:255',
            'apellidos' => 'required|max:255',
            'correo_electronico' => 'required|email|unique:pacientes',
            'f_nacimiento' => 'required|',
            'edad' => 'required|',
            'direccion' => 'required|max:255',
            'telefono' => 'required|max:255',
        ]);

        $pacientes = Paciente::findOrFail($id);
        $pacientes->tipo_identificacion = $request->tipo_identificacion;
        $pacientes->identificacion = $request->identificacion;
        $pacientes->nombres = $request->nombres;
        $pacientes->apellidos = $request->apellidos;
        $pacientes->correo_electronico = $request->correo_electronico;
        $pacientes->f_nacimiento = $request->f_nacimiento;
        $pacientes->edad = $request->edad;
        $pacientes->direccion = $request->direccion;
        $pacientes->telefono = $request->telefono;
        $pacientes->save();

        return redirect()->route('admin.pacientes.index')
        ->with('mensaje', 'El paciente se ha actualizado correctamente.')
        ->with('icono', 'success');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id){
        $pacientes = Paciente::findOrFail($id);
        $pacientes->delete();
        return redirect()->route('admin.pacientes.index')
        ->with('mensaje', 'El Paciente se ha eliminado correctamente.')
        ->with('icono', 'success');
    }
}
