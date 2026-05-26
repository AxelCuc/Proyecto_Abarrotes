<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Crear roles (si no existen)
        $adminRole = Role::firstOrCreate(['nombre' => 'admin']);
        $cajeroRole = Role::firstOrCreate(['nombre' => 'cajero']);

        // 2. Crear usuarios de prueba
        User::firstOrCreate(
            ['correo' => 'admin@donpepe.com'],
            [
                'nombre' => 'Administrador Principal',
                'password' => Hash::make('password'),
                'rol_id' => $adminRole->id,
            ]
        );

        User::firstOrCreate(
            ['correo' => 'cajero@donpepe.com'],
            [
                'nombre' => 'Cajero Juan',
                'password' => Hash::make('password'),
                'rol_id' => $cajeroRole->id,
            ]
        );

        // 3. Llamar a los seeders de categorías y productos
        $this->call([
            CategoriaSeeder::class,
            ProductoSeeder::class,
        ]);
    }
}
