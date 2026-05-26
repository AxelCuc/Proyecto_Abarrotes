<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Historial de precios de productos.
     * El precio vigente es aquel donde fecha_fin IS NULL.
     * Al actualizar precio: se cierra el registro anterior (fecha_fin = now())
     * y se inserta uno nuevo con fecha_inicio = now() y fecha_fin = null.
     */
    public function up(): void
    {
        Schema::create('precios_productos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('producto_id')
                  ->constrained('productos')
                  ->onDelete('cascade');
            $table->decimal('precio', 10, 2);
            $table->timestamp('fecha_inicio')->useCurrent();
            $table->timestamp('fecha_fin')->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('precios_productos');
    }
};
