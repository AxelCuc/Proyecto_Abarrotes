<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producto;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Mostrar listado de productos.
     */
    public function index()
    {
        $products = Producto::with('precioActual', 'categoria')->get();
        return view('admin.products.index', compact('products'));
    }

    /**
     * Formulario para crear un nuevo producto.
     */
    public function create()
    {
        return view('admin.products.create');
    }

    /**
     * Guardar un nuevo producto.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'nombre'        => 'required|string|max:255',
            'stock'         => 'required|integer',
            'categoria_id'  => 'required|exists:categorias,id',
            'fecha_caducidad' => 'nullable|date',
            'imagen'        => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        if ($request->hasFile('imagen')) {
            $data['imagen'] = $request->file('imagen')->store('productos', 'public');
        }

        Producto::create($data);

        return redirect()->route('admin.productos.index')
                         ->with('success', 'Producto creado correctamente');
    }

    /**
     * Mostrar un producto específico.
     */
    public function show(string $id)
    {
        $producto = Producto::with('precioActual', 'categoria')->findOrFail($id);
        return view('admin.products.show', compact('producto'));
    }

    /**
     * Formulario para editar un producto.
     */
    public function edit(string $id)
    {
        $producto = Producto::findOrFail($id);
        return view('admin.products.edit', compact('producto'));
    }

    /**
     * Actualizar un producto existente.
     */
    public function update(Request $request, string $id)
    {
        $producto = Producto::findOrFail($id);

        $data = $request->validate([
            'nombre'        => 'required|string|max:255',
            'stock'         => 'required|integer',
            'categoria_id'  => 'required|exists:categorias,id',
            'fecha_caducidad' => 'nullable|date',
            'imagen'        => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        if ($request->hasFile('imagen')) {
            // Eliminar imagen anterior si existe
            if ($producto->imagen) {
                Storage::disk('public')->delete($producto->imagen);
            }
            $data['imagen'] = $request->file('imagen')->store('productos', 'public');
        }

        $producto->update($data);

        return redirect()->route('admin.productos.index')
                         ->with('success', 'Producto actualizado correctamente');
    }

    /**
     * Eliminar un producto.
     */
    public function destroy(string $id)
    {
        $producto = Producto::findOrFail($id);

        if ($producto->imagen) {
            Storage::disk('public')->delete($producto->imagen);
        }

        $producto->delete();

        return redirect()->route('admin.productos.index')
                         ->with('success', 'Producto eliminado correctamente');
    }
}
