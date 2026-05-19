<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producto;
use App\Models\Categoria;

class InventarioController extends Controller
{
    public function index()
    {
        // Productos paginados (ej. 10 por página)
        $productos = Producto::paginate(10);

        // Total de productos registrados
        $totalProductos = Producto::count();

        // Productos con stock bajo (<= 5)
        $stockBajo = Producto::where('stock', '<=', 5)->count();

        // Número de categorías activas
        $categoriasActivas = Categoria::count();

        return view('cajero.inventario.index', compact(
            'productos',
            'totalProductos',
            'stockBajo',
            'categoriasActivas'
        ));
    }
}
