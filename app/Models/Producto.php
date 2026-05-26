<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;

    protected $table = 'productos';

    protected $fillable = [
        'nombre',
        'stock',
        'categoria_id',
        'fecha_caducidad',
        'imagen',
    ];

    /**
     * Relación con la categoría del producto.
     */
    public function categoria()
    {
        return $this->belongsTo(Categoria::class, 'categoria_id');
    }

    /**
     * Historial completo de precios del producto.
     */
    public function precios()
    {
        return $this->hasMany(PrecioProducto::class, 'producto_id');
    }

    /**
     * Precio vigente: el registro de precios_productos donde fecha_fin IS NULL.
     * Uso en vistas: $product->precioActual->precio ?? 0
     */
    public function precioActual()
    {
        return $this->hasOne(PrecioProducto::class, 'producto_id')
                    ->whereNull('fecha_fin')
                    ->latestOfMany('fecha_inicio');
    }

    /**
     * Accesor de conveniencia para obtener el precio directamente.
     * Uso: $product->precio_vigente
     */
    public function getPrecioVigenteAttribute(): float
    {
        return $this->precioActual?->precio ?? 0.0;
    }

    /**
     * Relación con los detalles de venta (para calcular más vendidos).
     */
    public function detalles()
    {
        return $this->hasMany(DetalleVenta::class, 'producto_id');
    }
}
