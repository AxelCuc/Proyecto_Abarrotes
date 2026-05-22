<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\VentaController;
use App\Http\Controllers\InventarioController;
use App\Http\Controllers\CajeroController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
| Aquí definimos las rutas públicas y protegidas del sistema.
*/

// ------------------- PÚBLICO ------------------- //
Route::get('/', function () {
    $products = \App\Models\Producto::all();
    return view('public.index', compact('products'));
})->name('home');

// ------------------- ADMIN ------------------- //
Route::get('/admin/login', function () {
    return view('admin.login');
})->name('admin.login');

Route::get('/admin/dashboard', function () {
    return view('admin.dashboard'); 
})->middleware('auth')->name('admin.dashboard');

// CRUD de productos (solo admin)
Route::resource('products', ProductController::class)->middleware('auth');

// ------------------- CAJERO ------------------- //
Route::get('/cajero/login', function () {
    return view('cajero.login');
})->name('cajero.login');

// ✅ Dashboard del cajero
Route::get('/cajero/dashboard', [CajeroController::class, 'dashboard'])
    ->middleware('auth')
    ->name('cajero.dashboard');

// Registrar venta
Route::get('/cajero/ventas/create', [VentaController::class, 'create'])
    ->middleware('auth')->name('cajero.ventas.create');
Route::post('/cajero/ventas', [VentaController::class, 'store'])
    ->middleware('auth')->name('cajero.ventas.store');

// Filtrar productos por categoría
Route::get('/cajero/ventas/categoria/{id}', [VentaController::class, 'porCategoria'])
    ->middleware('auth')->name('cajero.ventas.categoria');

// Historial de ventas (Todas las ventas)
Route::get('/cajero/ventas', [VentaController::class, 'index'])
    ->middleware('auth')->name('cajero.ventas.index');

// ✅ Filtro por rango de fechas
Route::get('/cajero/ventas/rango', [VentaController::class, 'filtroRango'])
    ->middleware('auth')
    ->name('cajero.ventas.rango');

// Ticket de venta
Route::get('/cajero/ventas/{venta}/ticket', [VentaController::class, 'ticket'])
    ->middleware('auth')->name('cajero.ventas.ticket');

// Inventario (solo lectura para cajero)
Route::get('/cajero/inventario', [InventarioController::class, 'index'])
    ->middleware('auth')->name('cajero.inventario.index');

// ------------------- AUTENTICACIÓN ------------------- //
require __DIR__.'/auth.php';
