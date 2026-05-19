<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producto;
use App\Models\Venta;
use App\Models\DetalleVenta;
use App\Models\Categoria;
use Illuminate\Support\Facades\Auth;

class VentaController extends Controller
{
    /**
     * Mostrar formulario para registrar venta (por defecto todos los productos)
     */
    public function create()
    {
        $categorias = Categoria::all();
        $productos = Producto::all();
        $categoriaSeleccionada = null; // ✅ siempre definida

        return view('cajero.ventas.create', compact('categorias','productos','categoriaSeleccionada'));
    }

    /**
     * Filtrar productos por categoría seleccionada
     */
    public function porCategoria(string $id)
    {
        $categorias = Categoria::all();

        if ($id === 'todos') {
            $productos = Producto::all();
            $categoriaSeleccionada = null;
        } else {
            $productos = Producto::where('categoria_id', (int)$id)->get();
            $categoriaSeleccionada = Categoria::find((int)$id);
        }

        return view('cajero.ventas.create', compact('categorias','productos','categoriaSeleccionada'));
    }

    /**
     * Guardar la venta en BD
     */
    public function store(Request $request)
    {
        // Crear venta principal
        $venta = Venta::create([
            'usuario_id' => Auth::id(),
            'total'      => $request->input('total'), // ✅ ahora viene del input hidden
        ]);

        // Guardar detalles de productos
        foreach ($request->input('productos', []) as $productoId => $datos) {
            $cantidad = $datos['cantidad'] ?? 0;
            $precio   = $datos['precio'] ?? 0;

            if ($cantidad > 0) {
                $producto = Producto::find($productoId);

                DetalleVenta::create([
                    'venta_id'    => $venta->id,
                    'producto_id' => $producto->id,
                    'cantidad'    => $cantidad,
                    'subtotal'    => $precio * $cantidad,
                ]);

                // Descontar stock
                $producto->decrement('stock', $cantidad);
            }
        }

        // ✅ Redirigir al dashboard del cajero con mensaje de éxito
        return redirect()->route('cajero.dashboard')
                         ->with('success', 'Venta registrada correctamente.');
    }

    /**
     * Mostrar ticket de venta (si lo quieres usar en lugar de dashboard)
     */
    public function ticket(Venta $venta)
    {
        $detalles = $venta->detalles; // relación con DetalleVenta
        return view('cajero.ventas.ticket', compact('venta', 'detalles'));
    }

    /**
     * Historial de ventas del cajero
     */
    public function index()
    {
        $ventas = Venta::where('usuario_id', Auth::id())->latest()->get();
        return view('cajero.ventas.index', compact('ventas'));
    }
}
