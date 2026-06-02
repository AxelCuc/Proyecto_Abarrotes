<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UsuarioController extends Controller
{
    /**
     * Mostrar listado de usuarios con roles
     */
    public function index()
    {
        $usuarios = User::with('rol')->paginate(10);
        $roles = \App\Models\Role::all(); // ✅ obtenemos todos los roles
        
        return view('admin.usuarios.index', compact('usuarios', 'roles'));
    }

    /**
     * Guardar nuevo usuario
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre'   => 'required|string|max:255',
            'email'    => 'required|email|unique:usuarios,email',
            'password' => 'required|min:6',
            'rol_id'   => 'required|exists:roles,id',
        ]);

        User::create([
            'nombre'   => $request->nombre,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
            'rol_id'   => $request->rol_id,
            'activo'   => true,
        ]);

        return redirect()->route('admin.usuarios.index')->with('success', 'Usuario creado correctamente.');
    }

    /**
     * Actualizar usuario
     */
    public function update(Request $request, User $usuario)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'email'  => 'required|email|unique:usuarios,email,' . $usuario->id,
            'rol_id' => 'required|exists:roles,id',
        ]);

        // Actualizar campos básicos
        $usuario->nombre = $request->nombre;
        $usuario->email  = $request->email;
        $usuario->rol_id = $request->rol_id;

        // Actualizar contraseña solo si se envía
        if ($request->filled('password')) {
            $usuario->password = Hash::make($request->password);
        }

        $usuario->save();

        return redirect()->route('admin.usuarios.index')->with('success', 'Usuario actualizado correctamente.');
    }

    /**
     * Eliminar usuario
     */
    public function destroy(User $usuario)
    {
        $usuario->delete();
        return redirect()->route('admin.usuarios.index')->with('success', 'Usuario eliminado correctamente.');
    }
}
