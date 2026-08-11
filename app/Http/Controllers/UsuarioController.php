<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UsuarioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $usuarios = User::all();
        return view('admin.usuarios.index', compact('usuarios'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.usuarios.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //$datos = request()->all();
        //return response()->json($datos);

        $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|max:255|unique:users',
            'password' => 'required|max:255|confirmed',
            'logo' => 'required|image|mimes:jpg, jpeg, png',
        ]);

        $usuario = new User();
        $usuario->name = $request->name;
        $usuario->email = $request->email;
        $usuario->password = Hash::make($request['password']);
        $usuario->logo = $request->file('logo')->store('logos', 'public');
        $usuario->save();

        return redirect()->route('admin.usuarios.index')
        ->with('mensaje', 'El usuario se ha creado correctamente.')
        ->with('icono', 'success');

    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $usuario = User::findOrFail($id);
        return view('admin.usuarios.show', compact('usuario'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $usuario = User::find($id);
        return view('admin.usuarios.edit', compact('usuario'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        //$datos = request()->all();
        //return response()->json($datos);

        $usuario = User::findOrFail($id);

        $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|max:255|unique:users,email,'.$usuario->id,
            'password' => 'nullable|min:8', // La contraseña es opcional al editar
            'logo'  => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $usuario->name = $request->name;
        $usuario->email = $request->email;

        if($request->filled('password')){

            $usuario->password = Hash::make($request['password']);
        }

        // 4. Lógica de subida de la nueva imagen (LOGO)
        if ($request->hasFile('logo')) {
            // A. Eliminar la imagen anterior si existe físicamente en el disco public
            if ($usuario->logo) {
                Storage::disk('public')->delete($usuario->logo);
            }

            // B. Guardar la nueva imagen directamente en el disco 'public' dentro de la carpeta 'logos'
            // El método 'store' genera un nombre único automáticamente y retorna la ruta relativa ("logos/nombre.jpg")
            $rutaImagen = $request->file('logo')->store('logos', 'public');

            // C. Guardar esa ruta exacta en la base de datos
            $usuario->logo = $rutaImagen;
        }

        $usuario->save();

        return redirect()->route('admin.usuarios.index')
        ->with('mensaje', 'El usuario se ha actualizado correctamente.')
        ->with('icono', 'success');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function confirmDelete($id)
    {
         $usuario = User::findOrFail($id);
        return view('admin.usuarios.delete', compact('usuario'));
    }

    public function destroy($id)
    {
         User::destroy($id);
         
        return redirect()->route('admin.usuarios.index')
        ->with('mensaje', 'El usuario se ha eliminado correctamente.')
        ->with('icono', 'success');
    }
}
