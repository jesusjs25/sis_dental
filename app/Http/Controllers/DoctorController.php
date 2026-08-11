<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class DoctorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $doctores = Doctor::with('user')->get();
        return view('admin.doctores.index', compact('doctores'));
    }

    // 📱 Método para retornar los doctores en formato JSON para la App Móvil
    public function indexApi()
    {
        // Buscamos los doctores con sus datos de usuario
        $doctores = Doctor::with('user')->get();
        
        // Respondemos con un JSON puro y un código 200 (Éxito)
        return response()->json($doctores, 200);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.doctores.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //$datos = request()->all();
        //return response()->json($datos);

        $request->validate([
            'nombres' => 'required',
            'apellidos' => 'required',
            'telefono' => 'required',
            'licencia_medica' => 'required',
            'especialidad' => 'required',
            'email' => 'required|max:255|unique:users',
            'password' => 'max:255|confirmed',
        ]);

        $usuario = new  User();
        $usuario->name = $request->nombres;
        $usuario->email = $request->email;
        $usuario->password = Hash::make($request['password']);
        $usuario->save();

        $doctor = new Doctor();
        $doctor->user_id = $usuario->id;
        $doctor->nombres = $request->nombres;
        $doctor->apellidos = $request->apellidos;
        $doctor->telefono = $request->telefono;
        $doctor->licencia_medica = $request->licencia_medica;
        $doctor->especialidad = $request->especialidad;
        $doctor->save();

        return redirect()->route('admin.doctores.index')
        ->with('mensaje', 'El doctor se ha creado correctamente.')
        ->with('icono', 'success');

    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $doctor = Doctor::findOrFail($id);
        return view('admin.doctores.show', compact('doctor'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $doctor = Doctor::findOrFail($id);
        return view('admin.doctores.edit', compact('doctor'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $doctor = Doctor::find($id);

        $request->validate([
            'nombres' => 'required',
            'apellidos' => 'required',
            'telefono' => 'required',
            'licencia_medica' => 'required',
            'especialidad' => 'required',
            'email' => 'required|max:255|unique:users,email,' .$doctor->user->id,
            'password' => 'nullable|max:255|confirmed',
        ]);
        
        $doctor->nombres = $request->nombres;
        $doctor->apellidos = $request->apellidos;
        $doctor->telefono = $request->telefono;
        $doctor->licencia_medica = $request->licencia_medica;
        $doctor->especialidad = $request->especialidad;
        $doctor->save();

        $usuario = User::find($doctor->user->id);
        $usuario->name = $request->nombres;
        $usuario->email = $request->email;
        if($request->filled('password')){

            $usuario->password = Hash::make($request['password']);
        }
        $usuario->save();

        return redirect()->route('admin.doctores.index')
        ->with('mensaje', 'El doctor se ha actualizado correctamente.')
        ->with('icono', 'success');

    }

    /**
     * Remove the specified resource from storage.
     */

    public function confirmDelete($id){

            $doctor = Doctor::findOrFail($id);
            return view('admin.doctores.delete',compact ('doctor'));
    }

    public function destroy($id)
    {
        $doctor = Doctor::find($id);

        //eliminar al usuario asociado
        $user = $doctor->user;
        $user->delete();

        //eliminar al doctor
          $doctor->delete();

        return redirect()->route('admin.doctores.index')
        ->with('mensaje', 'El doctor se ha eliminado correctamente.')
        ->with('icono', 'success');
    }
}
