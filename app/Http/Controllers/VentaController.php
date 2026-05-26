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
        $categoriaSeleccionada = null; // siempre definida

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
        } elseif ($id === 'mas-vendidos') {
            // Productos más vendidos dinámicos
            $productos = Producto::has('detalles')
                ->withSum('detalles', 'cantidad')
                ->orderByDesc('detalles_sum_cantidad')
                ->take(10)
                ->get();

            $categoriaSeleccionada = (object)[
                'id' => null,
                'nombre' => 'Más vendidos'
            ];
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
        'total'      => $request->input('total'), // viene del input hidden
    ]);

    // Guardar detalles de productos
    foreach ($request->input('productos', []) as $productoId => $datos) {
        $cantidad = $datos['cantidad'] ?? 0;

        if ($cantidad > 0) {
            $producto = Producto::find($productoId);

            // Obtener precio vigente del producto
            $precioUnitario = $producto->precioActual->precio ?? 0;

            DetalleVenta::create([
                'venta_id'       => $venta->id,
                'producto_id'    => $producto->id,
                'cantidad'       => $cantidad,
                'precio_unitario'=> $precioUnitario,
                'subtotal'       => $cantidad * $precioUnitario,
            ]);

            // Descontar stock
            $producto->decrement('stock', $cantidad);
        }
    }

    // Redirigir al dashboard del cajero con mensaje de éxito
    return redirect()->route('cajero.dashboard')
                     ->with('success', 'Venta registrada correctamente.');
}


    /**
     * Mostrar ticket de venta
     */
    public function ticket(Venta $venta)
    {
        $ventaDetalle = [
            'id' => $venta->id,
            'total' => number_format($venta->total, 2),
            'metodo_pago' => $venta->metodo_pago ?? 'Efectivo',
            'cajero' => $venta->usuario->nombre ?? 'Cajero',
            'url_ticket' => route('cajero.ventas.ticket', $venta->id),
            'productos' => $venta->detalles->map(function($detalle) {
                return [
                    'nombre' => $detalle->producto->nombre ?? 'Producto',
                    'cant' => $detalle->cantidad,
                    'precio_unitario' => number_format($detalle->precio_unitario, 2),
                    'subtotal' => number_format($detalle->subtotal, 2)
                ];
            })->toArray()
        ];

        return view('cajero.ventas.partials.modal-detalle', compact('ventaDetalle'));
    }

    /**
     * Historial de ventas del cajero (Todas las ventas con paginación)
     */
    public function index()
    {
        $ventas = Venta::where('usuario_id', Auth::id())
            ->latest()
            ->paginate(10);

        return view('cajero.ventas.index', compact('ventas'));
    }

    /**
     * Filtro de ventas por rango de fechas
     */
    public function filtroRango(Request $request)
    {
        $request->validate([
            'fecha_inicio' => 'required|date',
            'fecha_fin'    => 'required|date|after_or_equal:fecha_inicio',
        ]);

        $ventas = Venta::where('usuario_id', Auth::id())
            ->whereBetween('created_at', [$request->fecha_inicio, $request->fecha_fin])
            ->latest()
            ->paginate(10);

        return view('cajero.ventas.index', [
            'ventas' => $ventas,
            'fecha_inicio' => $request->fecha_inicio,
            'fecha_fin' => $request->fecha_fin,
        ]);
    }
}
