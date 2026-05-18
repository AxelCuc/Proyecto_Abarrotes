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
        Schema::create('roles', function (Blueprint $table) {
            $table->id(); // INT AUTO_INCREMENT PK
            $table->string('nombre', 50);
        });

        Schema::create('usuarios', function (Blueprint $table) {
            $table->bigIncrements('id'); // BIGINT AUTO_INCREMENT PK
            $table->string('nombre', 100);
            $table->string('correo', 100)->unique();
            $table->string('password', 255);
            $table->unsignedBigInteger('rol_id');
            $table->rememberToken(); // Requerido para Laravel Auth
            $table->timestamps();

            $table->foreign('rol_id')->references('id')->on('roles');
        });

        // Tablas requeridas por Laravel Auth
        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });

        Schema::create('cache', function (Blueprint $table) {
            $table->string('key')->primary();
            $table->mediumText('value');
            $table->integer('expiration');
        });

        Schema::create('cache_locks', function (Blueprint $table) {
            $table->string('key')->primary();
            $table->string('owner');
            $table->integer('expiration');
        });

        Schema::create('categorias', function (Blueprint $table) {
            $table->id(); // INT AUTO_INCREMENT PK
            $table->string('nombre', 100);
            $table->string('descripcion', 150)->nullable();
        });

        Schema::create('productos', function (Blueprint $table) {
            $table->bigIncrements('id'); // BIGINT AUTO_INCREMENT PK
            $table->string('nombre', 100);
            $table->decimal('precio', 10, 2);
            $table->integer('stock');
            $table->unsignedBigInteger('categoria_id');
            $table->date('fecha_caducidad')->nullable();
            $table->string('imagen', 255)->nullable();
            $table->timestamps();

            $table->foreign('categoria_id')->references('id')->on('categorias');
        });

        Schema::create('ventas', function (Blueprint $table) {
            $table->bigIncrements('id'); // BIGINT AUTO_INCREMENT PK
            $table->timestamp('fecha')->useCurrent();
            $table->decimal('total', 10, 2);
            $table->unsignedBigInteger('usuario_id');
            $table->timestamps();

            $table->foreign('usuario_id')->references('id')->on('usuarios');
        });

        Schema::create('detalle_ventas', function (Blueprint $table) {
            $table->bigIncrements('id'); // BIGINT AUTO_INCREMENT PK
            $table->unsignedBigInteger('venta_id');
            $table->unsignedBigInteger('producto_id');
            $table->integer('cantidad');
            $table->decimal('subtotal', 10, 2);

            $table->foreign('venta_id')->references('id')->on('ventas')->onDelete('cascade');
            $table->foreign('producto_id')->references('id')->on('productos');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detalle_ventas');
        Schema::dropIfExists('ventas');
        Schema::dropIfExists('productos');
        Schema::dropIfExists('categorias');
        
        Schema::dropIfExists('cache_locks');
        Schema::dropIfExists('cache');
        Schema::dropIfExists('sessions');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('usuarios');
        Schema::dropIfExists('roles');
    }
};
