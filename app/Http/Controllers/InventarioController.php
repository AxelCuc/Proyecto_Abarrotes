<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class InventarioController extends Controller
{
    /**
     * Mostrar inventario (solo lectura para cajero).
     */
    public function index()
    {
        $products = Product::all();
        return view('cajero.inventario.index', compact('products'));
    }
}
