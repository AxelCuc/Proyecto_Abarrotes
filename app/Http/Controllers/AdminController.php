<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use App\Models\Venta;
use App\Models\DetalleVenta;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function index()
    {
        $hoy = Carbon::today();

        // ── Tarjeta 1: Ventas del día ─────────────────────────────────────
        $ventasHoy = Venta::whereDate('fecha', $hoy)->sum('total');
        $transaccionesHoy = Venta::whereDate('fecha', $hoy)->count();

        // ── Tarjeta 2: Ingresos del mes en curso ──────────────────────────
        $ingresosMes = Venta::whereYear('fecha', $hoy->year)
                            ->whereMonth('fecha', $hoy->month)
                            ->sum('total');

        // ── Tarjeta 3: Productos con stock crítico (< 10) ─────────────────
        $productosCriticos = Producto::where('stock', '<', 10)
                                     ->orderBy('stock')
                                     ->get();

        // ── Gráfica 1: Ventas por día – últimos 7 días ────────────────────
        // Genera un mapa día => total para los 7 días (incluyendo días sin ventas).
        $inicio = $hoy->copy()->subDays(6)->startOfDay();

        $ventasRaw = Venta::select(
                            DB::raw('DATE(fecha) as dia'),
                            DB::raw('SUM(total) as total')
                        )
                        ->where('fecha', '>=', $inicio)
                        ->groupBy('dia')
                        ->orderBy('dia')
                        ->pluck('total', 'dia');

        // Colección indexada por etiqueta "Lu", "Ma"… con valor 0 si no hay ventas.
        $ventasPorDia = collect();
        for ($i = 6; $i >= 0; $i--) {
            $fecha = $hoy->copy()->subDays($i);
            $etiqueta = $fecha->locale('es')->isoFormat('ddd'); // Lun, Mar…
            $clave    = $fecha->toDateString();                 // 2026-05-22
            $ventasPorDia->put($etiqueta, (float) ($ventasRaw[$clave] ?? 0));
        }

        // ── Gráfica 2: Top-5 productos más vendidos (por cantidad) ────────
        $top5 = DetalleVenta::select('producto_id', DB::raw('SUM(cantidad) as total_vendido'))
                    ->groupBy('producto_id')
                    ->orderByDesc('total_vendido')
                    ->limit(5)
                    ->with('producto:id,nombre')
                    ->get();

        $totalVendido = $top5->sum('total_vendido') ?: 1; // evita /0

        // Estructura: [['nombre'=>'...','porcentaje'=>42], …]
        $productosMasVendidos = $top5->map(fn ($d) => [
            'nombre'     => $d->producto->nombre ?? 'Desconocido',
            'cantidad'   => (int) $d->total_vendido,
            'porcentaje' => round($d->total_vendido / $totalVendido * 100),
        ])->values();

        return view('admin.dashboard', compact(
            'ventasHoy',
            'transaccionesHoy',
            'ingresosMes',
            'productosCriticos',
            'ventasPorDia',
            'productosMasVendidos',
        ));
    }
}
