<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use App\Models\Venta;
use App\Models\DetalleVenta;
use Illuminate\Http\Request;
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

        $ingresosMesAnterior = Venta::whereYear('fecha', $hoy->copy()->subMonth()->year)
                                    ->whereMonth('fecha', $hoy->copy()->subMonth()->month)
                                    ->sum('total');

        $porcentajeIngresos = $ingresosMesAnterior > 0 
            ? (($ingresosMes - $ingresosMesAnterior) / $ingresosMesAnterior) * 100 
            : ($ingresosMes > 0 ? 100 : 0);

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
            'porcentajeIngresos',
            'productosCriticos',
            'ventasPorDia',
            'productosMasVendidos',
        ));
    }

    public function chartData(Request $request)
    {
        $rango = $request->query('rango', 'semana');
        $fechaFin = Carbon::today()->endOfDay();
        $fechaInicio = null;

        if ($rango === 'semana') {
            $fechaInicio = Carbon::today()->subDays(6)->startOfDay();
        } elseif ($rango === 'mes') {
            $fechaInicio = Carbon::today()->startOfMonth();
        } elseif ($rango === 'trimestre') {
            $fechaInicio = Carbon::today()->firstOfQuarter();
        } elseif ($rango === 'personalizado') {
            $start = $request->query('inicio');
            $end = $request->query('fin');
            if ($start && $end) {
                $fechaInicio = Carbon::parse($start)->startOfDay();
                $fechaFin = Carbon::parse($end)->endOfDay();
            } else {
                $fechaInicio = Carbon::today()->subDays(6)->startOfDay();
            }
        } else {
            $fechaInicio = Carbon::today()->subDays(6)->startOfDay();
        }

        $ventasRaw = Venta::select(
            DB::raw('DATE(fecha) as dia'),
            DB::raw('SUM(total) as total')
        )
        ->whereBetween('fecha', [$fechaInicio, $fechaFin])
        ->groupBy('dia')
        ->orderBy('dia')
        ->pluck('total', 'dia');

        $ventasPorDia = collect();
        $diasDiff = $fechaInicio->diffInDays($fechaFin);
        
        for ($i = 0; $i <= $diasDiff; $i++) {
            $fecha = $fechaInicio->copy()->addDays($i);
            // Si el rango es grande, usar fecha corta, si es corto usar día de la semana
            $etiqueta = $diasDiff > 14 ? $fecha->format('d/m') : $fecha->locale('es')->isoFormat('ddd');
            $clave = $fecha->toDateString();
            $ventasPorDia->put($etiqueta, (float) ($ventasRaw[$clave] ?? 0));
        }

        // Si el rango es muy grande (> 30 días), no repetir etiquetas para no saturar la gráfica
        $labels = $ventasPorDia->keys()->toArray();
        $data = $ventasPorDia->values()->toArray();

        return response()->json([
            'labels' => $labels,
            'data' => $data
        ]);
    }
}
