<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Role;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Crear roles
        $adminRole = Role::create(['nombre' => 'admin']);
        $cajeroRole = Role::create(['nombre' => 'cajero']);

        // 2. Crear usuarios de prueba
        User::create([
            'nombre' => 'Administrador Principal',
            'correo' => 'admin@donpepe.com',
            'password' => Hash::make('password'),
            'rol_id' => $adminRole->id,
        ]);

        User::create([
            'nombre' => 'Cajero Juan',
            'correo' => 'cajero@donpepe.com',
            'password' => Hash::make('password'),
            'rol_id' => $cajeroRole->id,
        ]);

        // 3. Llamar al seeder de productos
        $this->call(CategoriaSeeder::class);
        $this->call(ProductoSeeder::class);

    }
}


