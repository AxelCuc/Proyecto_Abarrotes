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
        $categoriaSeleccionada = null; //  siempre definida

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
            //  Productos más vendidos dinámicos
            $productos = Producto::join('detalle_ventas', 'productos.id', '=', 'detalle_ventas.producto_id')
                ->select('productos.*')
                ->selectRaw('SUM(detalle_ventas.cantidad) as total_vendidos')
                ->groupBy(
                    'productos.id',
                    'productos.nombre',
                    'productos.precio',
                    'productos.stock',
                    'productos.imagen',
                    'productos.categoria_id',
                    'productos.created_at',
                    'productos.updated_at'
                )
                ->orderByDesc('total_vendidos')
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
            'total'      => $request->input('total'), //  ahora viene del input hidden
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

        //  Redirigir al dashboard del cajero con mensaje de éxito
        return redirect()->route('cajero.dashboard')
                         ->with('success', 'Venta registrada correctamente.');
    }

    /**
     * Mostrar ticket de venta
     */
    public function ticket(Venta $venta)
    {
        $detalles = $venta->detalles; // relación con DetalleVenta
        return view('cajero.ventas.ticket', compact('venta', 'detalles'));
    }

    /**
     * Historial de ventas del cajero (con paginación)
     */
    public function index()
    {
        $ventas = Venta::where('usuario_id', Auth::id())
            ->latest()
            ->paginate(10);

        $periodo = 'todas'; // ✅ valor por defecto para evitar error en Blade

        return view('cajero.ventas.index', compact('ventas', 'periodo'));
    }

    /**
     * Filtro de ventas (Hoy, Semana, Mes, Todas)
     */
    public function filtro(string $periodo)
    {
        $query = Venta::where('usuario_id', Auth::id());

        switch ($periodo) {
            case 'hoy':
                $query->whereDate('created_at', today());
                break;

            case 'semana':
                $query->whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()]);
                break;

            case 'mes':
                $query->whereMonth('created_at', now()->month)
                      ->whereYear('created_at', now()->year);
                break;

            case 'todas':
                // No aplicamos ningún filtro de fecha
                break;
        }

        $ventas = $query->latest()->paginate(10);

        return view('cajero.ventas.index', compact('ventas', 'periodo'));
    }
}
