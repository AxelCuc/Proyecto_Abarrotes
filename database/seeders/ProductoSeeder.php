<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Producto;

class ProductoSeeder extends Seeder
{
    public function run(): void
    {
        Producto::create([
            'nombre' => 'Aguacate Hass Malla 1kg',
            'precio' => 45.00,
            'stock'  => 24,
            'categoria_id' => 1,
        ]);

        Producto::create([
            'nombre' => 'Leche Entera Lala 1L',
            'precio' => 24.50,
            'stock'  => 15,
            'categoria_id' => 2,
        ]);

        Producto::create([
            'nombre' => 'Papel Higiénico Pétalo 4pz',
            'precio' => 32.00,
            'stock'  => 3,
            'categoria_id' => 3,
        ]);

        Producto::create([
            'nombre' => 'Coca-Cola Retornable 2.5L',
            'precio' => 38.00,
            'stock'  => 45,
            'categoria_id' => 2,
        ]);
    }
}


