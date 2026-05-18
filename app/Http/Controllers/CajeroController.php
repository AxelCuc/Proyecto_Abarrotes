<?php

namespace App\Http\Controllers;

use App\Models\Venta;
use App\Models\Producto;
use Illuminate\Support\Facades\Auth;

class CajeroController extends Controller
{
    public function dashboard()
    {
        // Total vendido hoy
        $totalHoy = Venta::whereDate('fecha', today())
                         ->where('usuario_id', Auth::id())
                         ->sum('total');

        // Número de ventas hoy
        $ventasHoy = Venta::whereDate('fecha', today())
                          ->where('usuario_id', Auth::id())
                          ->count();

        // Comparación con ayer
        $totalAyer = Venta::whereDate('fecha', today()->subDay())
                          ->where('usuario_id', Auth::id())
                          ->sum('total');
        $comparacion = $totalAyer > 0 
            ? round((($totalHoy - $totalAyer) / $totalAyer) * 100, 2)
            : 0;

        // Productos con poco stock
        $productosBajos = Producto::where('stock', '<=', 5)->get();

        return view('cajero.dashboard', compact('totalHoy','ventasHoy','comparacion','productosBajos'));
    }
}
