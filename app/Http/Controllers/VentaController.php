<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producto;
use App\Models\Venta;
use App\Models\DetalleVenta;
use App\Models\Categoria;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

// Librerías para exportación
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\VentasExport;
use Barryvdh\DomPDF\Facade\Pdf;

class VentaController extends Controller
{
    public function create()
    {
        $categorias = Categoria::all();
        $productos = Producto::all();
        $categoriaSeleccionada = null;

        return view('cajero.ventas.create', compact('categorias','productos','categoriaSeleccionada'));
    }

    public function porCategoria(string $id)
    {
        $categorias = Categoria::all();

        if ($id === 'todos') {
            $productos = Producto::all();
            $categoriaSeleccionada = null;
        } elseif ($id === 'mas-vendidos') {
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

    public function store(Request $request)
    {
        $venta = Venta::create([
            'usuario_id' => Auth::id(),
            'total'      => $request->input('total'),
        ]);

        foreach ($request->input('productos', []) as $productoId => $datos) {
            $cantidad = $datos['cantidad'] ?? 0;

            if ($cantidad > 0) {
                $producto = Producto::find($productoId);
                $precioUnitario = $producto->precioActual->precio ?? 0;

                DetalleVenta::create([
                    'venta_id'       => $venta->id,
                    'producto_id'    => $producto->id,
                    'cantidad'       => $cantidad,
                    'precio_unitario'=> $precioUnitario,
                    'subtotal'       => $cantidad * $precioUnitario,
                ]);

                $producto->decrement('stock', $cantidad);
            }
        }

        return redirect()->route('cajero.dashboard')
                         ->with('success', 'Venta registrada correctamente.');
    }

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

    public function index(Request $request)
    {
        if ($request->routeIs('admin.*')) {
            $query = Venta::with(['usuario','detalles.producto']);

            // Filtro por fecha
            if ($request->filled('fecha_inicio') && $request->filled('fecha_fin')) {
                $query->whereBetween('created_at', [
                    $request->fecha_inicio . ' 00:00:00',
                    $request->fecha_fin . ' 23:59:59'
                ]);
            }

            // Filtro por cajero
            if ($request->filled('cajero_id')) {
                $query->where('usuario_id', $request->cajero_id);
            }

            // ✅ Clonar query para KPIs
            $kpiQuery = clone $query;

            // Paginación con filtros
            $ventas = $query->latest()->paginate(10)->appends($request->all());

            // Cajeros
            $cajeros = User::whereHas('rol', function($q) {
                $q->where('nombre', 'cajero');
            })->get();

            // KPIs
            $totalVentas = $kpiQuery->count();
            $totalIngresos = $kpiQuery->sum('total');
            $numTransacciones = $kpiQuery->count();
            $productoMasVendido = DetalleVenta::select('producto_id')
                ->join('ventas','detalle_ventas.venta_id','=','ventas.id')
                ->when($request->filled('fecha_inicio') && $request->filled('fecha_fin'), function($q) use ($request) {
                    $q->whereBetween('ventas.created_at', [
                        $request->fecha_inicio . ' 00:00:00',
                        $request->fecha_fin . ' 23:59:59'
                    ]);
                })
                ->when($request->filled('cajero_id'), function($q) use ($request) {
                    $q->where('ventas.usuario_id', $request->cajero_id);
                })
                ->groupBy('producto_id')
                ->orderByRaw('SUM(detalle_ventas.cantidad) DESC')
                ->with('producto')
                ->first()?->producto->nombre ?? 'N/A';

            return view('admin.ventas.index', compact(
                'ventas',
                'cajeros',
                'totalVentas',
                'totalIngresos',
                'numTransacciones',
                'productoMasVendido'
            ));
        }

        // Vista del cajero
        $ventas = Venta::where('usuario_id', Auth::id())
            ->latest()
            ->paginate(10);

        return view('cajero.ventas.index', compact('ventas'));
    }

    public function filtroRango(Request $request)
    {
        $request->validate([
            'fecha_inicio' => 'required|date',
            'fecha_fin'    => 'required|date|after_or_equal:fecha_inicio',
        ]);

        $ventas = Venta::where('usuario_id', Auth::id())
            ->whereBetween('created_at', [
                $request->fecha_inicio . ' 00:00:00',
                $request->fecha_fin . ' 23:59:59'
            ])
            ->latest()
            ->paginate(10)
            ->appends($request->all());

        return view('cajero.ventas.index', [
            'ventas' => $ventas,
            'fecha_inicio' => $request->fecha_inicio,
            'fecha_fin' => $request->fecha_fin,
        ]);
    }

    public function exportExcel()
    {
        return Excel::download(new VentasExport, 'ventas.xlsx');
    }

    public function exportPdf()
    {
        $ventas = Venta::with(['usuario','detalles.producto'])->get();
        $pdf = Pdf::loadView('admin.ventas.pdf', compact('ventas'));
        return $pdf->download('ventas.pdf');
    }
}
