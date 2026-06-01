<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UsuarioController extends Controller
{
    /**
     * Mostrar listado de usuarios con roles
     */
    public function index()
    {
        $usuarios = User::with('rol')->paginate(10);
        return view('admin.usuarios.index', compact('usuarios'));
    }

    /**
     * Guardar nuevo usuario
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre'   => 'required|string|max:255',
            'email'    => 'required|email|unique:usuarios,email', // 🔧 ahora valida contra la tabla correcta
            'password' => 'required|min:6',
            'rol_id'   => 'required|exists:roles,id',
        ]);

        User::create([
            'nombre'   => $request->nombre,
            'email'    => $request->email,
            'password' => bcrypt($request->password),
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
            'email'  => 'required|email|unique:usuarios,email,'.$usuario->id, // 🔧 apunta a "usuarios"
            'rol_id' => 'required|exists:roles,id',
        ]);

        $usuario->update([
            'nombre' => $request->nombre,
            'email'  => $request->email,
            'rol_id' => $request->rol_id,
        ]);

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
