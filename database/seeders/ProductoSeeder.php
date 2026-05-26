<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Producto;
use App\Models\PrecioProducto;

class ProductoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Ejemplo de categorías ya existentes (asegúrate de tenerlas en CategoriaSeeder)
        $productos = [
            [
                'nombre' => 'Coca Cola 600ml',
                'stock' => 50,
                'categoria_id' => 1, // Bebidas
                'precio' => 15.00,
            ],
            [
                'nombre' => 'Galletas Oreo',
                'stock' => 30,
                'categoria_id' => 2, // Snacks
                'precio' => 25.00,
            ],
            [
                'nombre' => 'Leche Entera 1L',
                'stock' => 40,
                'categoria_id' => 3, // Lácteos
                'precio' => 22.50,
            ],
            [
                'nombre' => 'Papas Fritas 150g',
                'stock' => 20,
                'categoria_id' => 2, // Snacks
                'precio' => 18.00,
            ],
        ];

        foreach ($productos as $data) {
            $producto = Producto::create([
                'nombre' => $data['nombre'],
                'stock' => $data['stock'],
                'categoria_id' => $data['categoria_id'],
                'imagen' => null,
            ]);

            PrecioProducto::create([
                'producto_id' => $producto->id,
                'precio' => $data['precio'],
                'fecha_inicio' => now(),
                'fecha_fin' => null,
            ]);
        }
    }
}
