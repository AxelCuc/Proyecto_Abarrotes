<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Producto;   // 👈 Usa tu modelo correcto
use App\Models\Venta;
use App\Models\DetalleVenta;

class VentaController extends Controller
{
    /**
     * Mostrar formulario de venta
     */
    public function create()
    {
        // Obtener todos los productos de la BD
        $products = Producto::all();

        // Pasar productos a la vista
        return view('cajero.ventas.create', compact('products'));
    }

    /**
     * Guardar la venta en BD
     */
    public function store(Request $request)
    {
        // Crear la venta principal
        $venta = Venta::create([
            'usuario_id' => Auth::id(),
            'total'      => $request->input('total'),
        ]);

        // Guardar detalles de cada producto
        foreach ($request->input('productos', []) as $productoId => $cantidad) {
            if ($cantidad > 0) {
                $producto = Producto::find($productoId);

                DetalleVenta::create([
                    'venta_id'    => $venta->id,
                    'producto_id' => $producto->id,
                    'cantidad'    => $cantidad,
                    'subtotal'    => $producto->precio * $cantidad,
                ]);

                // Descontar stock
                $producto->decrement('stock', $cantidad);
            }
        }

        // Redirigir al ticket de la venta
        return redirect()->route('cajero.ventas.ticket', $venta->id);
    }

    /**
     * Mostrar ticket de venta
     */
    public function ticket(Venta $venta)
    {
        $detalles = $venta->detalles; // relación con DetalleVenta
        return view('cajero.ventas.ticket', compact('venta', 'detalles'));
    }
}
