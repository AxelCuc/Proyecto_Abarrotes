<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');                // Nombre del producto
            $table->decimal('precio', 8, 2);         // Precio con 2 decimales
            $table->integer('cantidad');             // Stock disponible
            $table->string('imagen')->nullable();    // Ruta de la imagen (opcional)
            $table->timestamps();                    // created_at y updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
