<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Exports\VentasExport;
use App\Models\Venta;
use App\Models\Producto;
use App\Models\Categoria;
use App\Models\User;

class ReporteController extends Controller
{
    // =========================================================================
    //  HELPERS PRIVADOS
    // =========================================================================

    /**
     * Devuelve un Builder de Venta con los filtros del request ya aplicados.
     * Reutilizado por index() y exportPdf() para garantizar consistencia.
     *
     * Filtros soportados:
     *   - fecha_inicio / fecha_fin  → whereBetween('fecha', [...])
     *   - cajero_id                 → where('usuario_id', ...)
     *   - categoria_id              → whereHas en detalles > producto.categoria_id
     */
    private function ventaQuery(Request $request): Builder
    {
        $query = Venta::query();

        // ── Rango de fechas ────────────────────────────────────────────────
        $inicio = $request->filled('fecha_inicio') ? $request->fecha_inicio : null;
        $fin    = $request->filled('fecha_fin')    ? $request->fecha_fin    : null;

        if ($inicio && $fin) {
            // Incluye todo el día final (hasta las 23:59:59)
            $query->whereBetween('fecha', [$inicio . ' 00:00:00', $fin . ' 23:59:59']);
        } elseif ($inicio) {
            $query->where('fecha', '>=', $inicio . ' 00:00:00');
        } elseif ($fin) {
            $query->where('fecha', '<=', $fin . ' 23:59:59');
        }

        // ── Cajero ─────────────────────────────────────────────────────────
        if ($request->filled('cajero_id')) {
            $query->where('usuario_id', $request->cajero_id);
        }

        // ── Categoría: ventas que tengan al menos un detalle del producto
        //   de esa categoría (DetalleVenta → Producto → categoria_id) ──────
        if ($request->filled('categoria_id')) {
            $catId = $request->categoria_id;
            $query->whereHas('detalles.producto', function (Builder $q) use ($catId) {
                $q->where('categoria_id', $catId);
            });
        }

        return $query;
    }

    /**
     * Aplica los mismos filtros de fecha/cajero/categoría a un Builder
     * de Producto para los datasets de top-productos.
     */
    private function productoQuery(Request $request): Builder
    {
        $query = Producto::withCount(['detalles as detalles_count' => function (Builder $q) use ($request) {
            // Filtrar los detalles por las ventas que cumplen los criterios
            $q->whereHas('venta', function (Builder $vq) use ($request) {
                if ($request->filled('fecha_inicio') && $request->filled('fecha_fin')) {
                    $vq->whereBetween('fecha', [
                        $request->fecha_inicio . ' 00:00:00',
                        $request->fecha_fin    . ' 23:59:59',
                    ]);
                } elseif ($request->filled('fecha_inicio')) {
                    $vq->where('fecha', '>=', $request->fecha_inicio . ' 00:00:00');
                } elseif ($request->filled('fecha_fin')) {
                    $vq->where('fecha', '<=', $request->fecha_fin . ' 23:59:59');
                }

                if ($request->filled('cajero_id')) {
                    $vq->where('usuario_id', $request->cajero_id);
                }
            });
        }]);

        // Si hay filtro de categoría, solo mostrar productos de esa categoría
        if ($request->filled('categoria_id')) {
            $query->where('categoria_id', $request->categoria_id);
        }

        return $query;
    }

    // =========================================================================
    //  ACCIONES
    // =========================================================================

    /**
     * Calcula KPIs y datasets aplicando los filtros del request,
     * luego retorna la vista de reportes.
     */
    public function index(Request $request)
    {
        $vq = $this->ventaQuery($request);   // Builder de Venta filtrado

        // ── KPIs ──────────────────────────────────────────────────────────
        $totalVentas    = (clone $vq)->count();
        $totalIngresos  = (clone $vq)->sum('total');
        $ticketPromedio = (clone $vq)->avg('total');

        // Producto más vendido (filtrado)
        $productoMasVendido = $this->productoQuery($request)
            ->orderByDesc('detalles_count')
            ->first()?->nombre;

        // Cajero top: solo cajeros, filtrado por ventas del período
        $cajeroTop = User::whereHas('rol', fn($q) => $q->where('nombre', 'cajero'))
            ->withCount(['ventas as ventas_count' => function (Builder $q) use ($request) {
                if ($request->filled('fecha_inicio') && $request->filled('fecha_fin')) {
                    $q->whereBetween('fecha', [
                        $request->fecha_inicio . ' 00:00:00',
                        $request->fecha_fin    . ' 23:59:59',
                    ]);
                } elseif ($request->filled('fecha_inicio')) {
                    $q->where('fecha', '>=', $request->fecha_inicio . ' 00:00:00');
                } elseif ($request->filled('fecha_fin')) {
                    $q->where('fecha', '<=', $request->fecha_fin . ' 23:59:59');
                }
                if ($request->filled('cajero_id')) {
                    $q->where('usuario_id', $request->cajero_id);
                }
            }])
            ->orderByDesc('ventas_count')
            ->first()?->nombre;

        // ── Datasets (->toArray() → objeto JS plano que Chart.js puede leer) ──
        $ventasPorDia = (clone $vq)
            ->selectRaw('DATE(fecha) as dia, COUNT(*) as total')
            ->groupBy('dia')
            ->orderBy('dia')
            ->pluck('total', 'dia')
            ->toArray();

        $ingresosPorDia = (clone $vq)
            ->selectRaw('DATE(fecha) as dia, SUM(total) as ingresos')
            ->groupBy('dia')
            ->orderBy('dia')
            ->pluck('ingresos', 'dia')
            ->toArray();

        $topProductos = Producto::select('productos.nombre')
            ->join('detalle_ventas', 'productos.id', '=', 'detalle_ventas.producto_id')
            ->join('ventas', 'detalle_ventas.venta_id', '=', 'ventas.id')
            ->when($request->filled('fecha_inicio') && $request->filled('fecha_fin'), fn($q) =>
                $q->whereBetween('ventas.fecha', [$request->fecha_inicio . ' 00:00:00', $request->fecha_fin . ' 23:59:59'])
            )
            ->when($request->filled('fecha_inicio') && !$request->filled('fecha_fin'), fn($q) =>
                $q->where('ventas.fecha', '>=', $request->fecha_inicio . ' 00:00:00')
            )
            ->when(!$request->filled('fecha_inicio') && $request->filled('fecha_fin'), fn($q) =>
                $q->where('ventas.fecha', '<=', $request->fecha_fin . ' 23:59:59')
            )
            ->when($request->filled('cajero_id'), fn($q) =>
                $q->where('ventas.usuario_id', $request->cajero_id)
            )
            ->when($request->filled('categoria_id'), fn($q) =>
                $q->where('productos.categoria_id', $request->categoria_id)
            )
            ->selectRaw('SUM(detalle_ventas.cantidad) as total')
            ->groupBy('productos.nombre')
            ->orderByDesc('total')
            ->take(5)
            ->pluck('total', 'productos.nombre')
            ->toArray();

        // Categorías: suma de unidades vendidas agrupada por categoría
        $categoriasDistribucion = Categoria::select('categorias.nombre')
            ->join('productos', 'categorias.id', '=', 'productos.categoria_id')
            ->join('detalle_ventas', 'productos.id', '=', 'detalle_ventas.producto_id')
            ->join('ventas', 'detalle_ventas.venta_id', '=', 'ventas.id')
            ->when($request->filled('fecha_inicio') && $request->filled('fecha_fin'), fn($q) =>
                $q->whereBetween('ventas.fecha', [$request->fecha_inicio . ' 00:00:00', $request->fecha_fin . ' 23:59:59'])
            )
            ->when($request->filled('fecha_inicio') && !$request->filled('fecha_fin'), fn($q) =>
                $q->where('ventas.fecha', '>=', $request->fecha_inicio . ' 00:00:00')
            )
            ->when(!$request->filled('fecha_inicio') && $request->filled('fecha_fin'), fn($q) =>
                $q->where('ventas.fecha', '<=', $request->fecha_fin . ' 23:59:59')
            )
            ->when($request->filled('cajero_id'), fn($q) =>
                $q->where('ventas.usuario_id', $request->cajero_id)
            )
            ->when($request->filled('categoria_id'), fn($q) =>
                $q->where('categorias.id', $request->categoria_id)
            )
            ->selectRaw('SUM(detalle_ventas.cantidad) as total')
            ->groupBy('categorias.nombre')
            ->pluck('total', 'categorias.nombre')
            ->toArray();

        $ventasPorCajero = User::whereHas('rol', fn($q) => $q->where('nombre', 'cajero'))
            ->withCount(['ventas as ventas_count' => function (Builder $q) use ($request) {
                if ($request->filled('fecha_inicio') && $request->filled('fecha_fin')) {
                    $q->whereBetween('fecha', [
                        $request->fecha_inicio . ' 00:00:00',
                        $request->fecha_fin    . ' 23:59:59',
                    ]);
                } elseif ($request->filled('fecha_inicio')) {
                    $q->where('fecha', '>=', $request->fecha_inicio . ' 00:00:00');
                } elseif ($request->filled('fecha_fin')) {
                    $q->where('fecha', '<=', $request->fecha_fin . ' 23:59:59');
                }
                if ($request->filled('cajero_id')) {
                    $q->where('usuario_id', $request->cajero_id);
                }
            }])
            ->orderByDesc('ventas_count')
            ->pluck('ventas_count', 'nombre')
            ->toArray();

        // ── Selectores de filtro para los <select> de la vista ─────────────
        $cajeros    = User::whereHas('rol', fn($q) => $q->where('nombre', 'cajero'))->get();
        $categorias = Categoria::all();

        return view('admin.reportes.index', compact(
            'totalVentas', 'totalIngresos', 'ticketPromedio',
            'productoMasVendido', 'cajeroTop',
            'ventasPorDia', 'ingresosPorDia', 'topProductos',
            'categoriasDistribucion', 'ventasPorCajero',
            'cajeros', 'categorias'
        ));
    }

    /**
     * Exportar ventas a Excel usando Laravel Excel.
     */
    public function exportExcel(Request $request)
    {
        return Excel::download(new VentasExport, 'reportes.xlsx');
    }

    /**
     * Exportar reporte a PDF usando DomPDF, respetando los mismos filtros.
     */
    public function exportPdf(Request $request)
    {
        $vq = $this->ventaQuery($request);   // Builder filtrado

        // ── KPIs ──────────────────────────────────────────────────────────
        $totalVentas    = (clone $vq)->count();
        $totalIngresos  = (clone $vq)->sum('total');
        $ticketPromedio = (clone $vq)->avg('total');

        $productoMasVendido = $this->productoQuery($request)
            ->orderByDesc('detalles_count')
            ->first()?->nombre;

        $cajeroTop = User::whereHas('rol', fn($q) => $q->where('nombre', 'cajero'))
            ->withCount(['ventas as ventas_count' => function (Builder $q) use ($request) {
                if ($request->filled('fecha_inicio') && $request->filled('fecha_fin')) {
                    $q->whereBetween('fecha', [
                        $request->fecha_inicio . ' 00:00:00',
                        $request->fecha_fin    . ' 23:59:59',
                    ]);
                } elseif ($request->filled('fecha_inicio')) {
                    $q->where('fecha', '>=', $request->fecha_inicio . ' 00:00:00');
                } elseif ($request->filled('fecha_fin')) {
                    $q->where('fecha', '<=', $request->fecha_fin . ' 23:59:59');
                }
                if ($request->filled('cajero_id')) {
                    $q->where('usuario_id', $request->cajero_id);
                }
            }])
            ->orderByDesc('ventas_count')
            ->first()?->nombre;

        // ── Datasets ──────────────────────────────────────────────────────
        $ventasPorDia = (clone $vq)
            ->selectRaw('DATE(fecha) as dia, COUNT(*) as total')
            ->groupBy('dia')
            ->orderBy('dia')
            ->pluck('total', 'dia')
            ->toArray();

        $ingresosPorDia = (clone $vq)
            ->selectRaw('DATE(fecha) as dia, SUM(total) as ingresos')
            ->groupBy('dia')
            ->orderBy('dia')
            ->pluck('ingresos', 'dia')
            ->toArray();

        $topProductos = Producto::select('productos.nombre')
            ->join('detalle_ventas', 'productos.id', '=', 'detalle_ventas.producto_id')
            ->join('ventas', 'detalle_ventas.venta_id', '=', 'ventas.id')
            ->when($request->filled('fecha_inicio') && $request->filled('fecha_fin'), fn($q) =>
                $q->whereBetween('ventas.fecha', [$request->fecha_inicio . ' 00:00:00', $request->fecha_fin . ' 23:59:59'])
            )
            ->when($request->filled('fecha_inicio') && !$request->filled('fecha_fin'), fn($q) =>
                $q->where('ventas.fecha', '>=', $request->fecha_inicio . ' 00:00:00')
            )
            ->when(!$request->filled('fecha_inicio') && $request->filled('fecha_fin'), fn($q) =>
                $q->where('ventas.fecha', '<=', $request->fecha_fin . ' 23:59:59')
            )
            ->when($request->filled('cajero_id'), fn($q) =>
                $q->where('ventas.usuario_id', $request->cajero_id)
            )
            ->when($request->filled('categoria_id'), fn($q) =>
                $q->where('productos.categoria_id', $request->categoria_id)
            )
            ->selectRaw('SUM(detalle_ventas.cantidad) as total')
            ->groupBy('productos.nombre')
            ->orderByDesc('total')
            ->take(5)
            ->pluck('total', 'productos.nombre')
            ->toArray();

        $categoriasDistribucion = Categoria::select('categorias.nombre')
            ->join('productos', 'categorias.id', '=', 'productos.categoria_id')
            ->join('detalle_ventas', 'productos.id', '=', 'detalle_ventas.producto_id')
            ->join('ventas', 'detalle_ventas.venta_id', '=', 'ventas.id')
            ->when($request->filled('fecha_inicio') && $request->filled('fecha_fin'), fn($q) =>
                $q->whereBetween('ventas.fecha', [$request->fecha_inicio . ' 00:00:00', $request->fecha_fin . ' 23:59:59'])
            )
            ->when($request->filled('fecha_inicio') && !$request->filled('fecha_fin'), fn($q) =>
                $q->where('ventas.fecha', '>=', $request->fecha_inicio . ' 00:00:00')
            )
            ->when(!$request->filled('fecha_inicio') && $request->filled('fecha_fin'), fn($q) =>
                $q->where('ventas.fecha', '<=', $request->fecha_fin . ' 23:59:59')
            )
            ->when($request->filled('cajero_id'), fn($q) =>
                $q->where('ventas.usuario_id', $request->cajero_id)
            )
            ->when($request->filled('categoria_id'), fn($q) =>
                $q->where('categorias.id', $request->categoria_id)
            )
            ->selectRaw('SUM(detalle_ventas.cantidad) as total')
            ->groupBy('categorias.nombre')
            ->pluck('total', 'categorias.nombre')
            ->toArray();

        $ventasPorCajero = User::whereHas('rol', fn($q) => $q->where('nombre', 'cajero'))
            ->withCount(['ventas as ventas_count' => function (Builder $q) use ($request) {
                if ($request->filled('fecha_inicio') && $request->filled('fecha_fin')) {
                    $q->whereBetween('fecha', [
                        $request->fecha_inicio . ' 00:00:00',
                        $request->fecha_fin    . ' 23:59:59',
                    ]);
                } elseif ($request->filled('fecha_inicio')) {
                    $q->where('fecha', '>=', $request->fecha_inicio . ' 00:00:00');
                } elseif ($request->filled('fecha_fin')) {
                    $q->where('fecha', '<=', $request->fecha_fin . ' 23:59:59');
                }
                if ($request->filled('cajero_id')) {
                    $q->where('usuario_id', $request->cajero_id);
                }
            }])
            ->orderByDesc('ventas_count')
            ->pluck('ventas_count', 'nombre')
            ->toArray();

        $pdf = Pdf::loadView('admin.reportes.pdf', compact(
            'totalVentas', 'totalIngresos', 'ticketPromedio',
            'productoMasVendido', 'cajeroTop',
            'ventasPorDia', 'ingresosPorDia', 'topProductos',
            'categoriasDistribucion', 'ventasPorCajero'
        ))->setPaper('a4', 'portrait');

        return $pdf->download('reportes.pdf');
    }
}
