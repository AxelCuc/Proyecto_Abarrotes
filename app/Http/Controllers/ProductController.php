<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producto;
use App\Models\Categoria;
use App\Models\PrecioProducto;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    /**
     * Mostrar listado de productos con filtros y paginación.
     */
    public function index(Request $request)
    {
        $query = Producto::with('precioActual', 'categoria');

        // Filtro por categoría
        if ($request->filled('categoria')) {
            $query->where('categoria_id', $request->categoria);
        }

        // Filtro por stock crítico
        if ($request->stock === 'critico') {
            $query->where('stock', '<=', 5);
        }

        // Búsqueda por nombre
        if ($request->filled('q')) {
            $query->where('nombre', 'like', '%' . $request->q . '%');
        }

        $productos   = $query->orderBy('nombre')->paginate(12)->withQueryString();
        $categorias  = Categoria::orderBy('nombre')->get();

        return view('admin.products.index', compact('productos', 'categorias'));
    }

    /**
     * Guardar un nuevo producto (recibe precio para crear registro en precios_productos).
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'nombre'          => 'required|string|max:255',
            'stock'           => 'required|integer|min:0',
            'categoria_id'    => 'required|exists:categorias,id',
            'precio'          => 'required|numeric|min:0',
            'fecha_caducidad' => 'nullable|date',
            'imagen'          => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        if ($request->hasFile('imagen')) {
            $data['imagen'] = $request->file('imagen')->store('productos', 'public');
        }

        $precio = $data['precio'];
        unset($data['precio']);

        DB::transaction(function () use ($data, $precio) {
            $producto = Producto::create($data);
            $producto->precios()->create([
                'precio'       => $precio,
                'fecha_inicio' => now(),
                'fecha_fin'    => null,
            ]);
        });

        return redirect()->route('admin.productos.index')
                         ->with('success', 'Producto creado correctamente.');
    }

    /**
     * Actualizar un producto existente y su precio vigente si cambió.
     */
    public function update(Request $request, string $id)
    {
        $producto = Producto::with('precioActual')->findOrFail($id);

        $data = $request->validate([
            'nombre'          => 'required|string|max:255',
            'stock'           => 'required|integer|min:0',
            'categoria_id'    => 'required|exists:categorias,id',
            'precio'          => 'required|numeric|min:0',
            'fecha_caducidad' => 'nullable|date',
            'imagen'          => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        if ($request->hasFile('imagen')) {
            if ($producto->imagen) {
                Storage::disk('public')->delete($producto->imagen);
            }
            $data['imagen'] = $request->file('imagen')->store('productos', 'public');
        }

        $nuevoPrecio = $data['precio'];
        unset($data['precio']);

        DB::transaction(function () use ($producto, $data, $nuevoPrecio) {
            $producto->update($data);

            $precioActual = $producto->precioActual;

            // Solo crear nuevo registro de precio si cambió
            if (!$precioActual || (float) $precioActual->precio !== (float) $nuevoPrecio) {
                if ($precioActual) {
                    $precioActual->update(['fecha_fin' => now()]);
                }
                $producto->precios()->create([
                    'precio'       => $nuevoPrecio,
                    'fecha_inicio' => now(),
                    'fecha_fin'    => null,
                ]);
            }
        });

        return redirect()->route('admin.productos.index')
                         ->with('success', 'Producto actualizado correctamente.');
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
                         ->with('success', 'Producto eliminado correctamente.');
    }

    // ── Los métodos show, create y edit se conservan por si se usan en rutas ──

    public function show(string $id)
    {
        $producto = Producto::with('precioActual', 'categoria')->findOrFail($id);
        return view('admin.products.show', compact('producto'));
    }

    public function create()
    {
        $categorias = Categoria::orderBy('nombre')->get();
        return view('admin.products.create', compact('categorias'));
    }

    public function edit(string $id)
    {
        $producto   = Producto::with('precioActual')->findOrFail($id);
        $categorias = Categoria::orderBy('nombre')->get();
        return view('admin.products.edit', compact('producto', 'categorias'));
    }
}
