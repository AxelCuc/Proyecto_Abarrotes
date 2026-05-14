<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class VentaController extends Controller
{
    public function create()
    {
        return view('cajero.ventas.create'); // formulario de venta
    }

    public function store(Request $request)
    {
        // lógica para guardar la venta
    }
}
