<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PrecioProducto extends Model
{
    use HasFactory;

    protected $table = 'precios_productos';
    public $timestamps = false;

    protected $fillable = [
        'producto_id',
        'precio',
        'fecha_inicio',
        'fecha_fin',
    ];

    protected $casts = [
        'precio'      => 'decimal:2',
        'fecha_inicio' => 'datetime',
        'fecha_fin'    => 'datetime',
    ];

    /**
     * Producto al que pertenece este precio.
     */
    public function producto()
    {
        return $this->belongsTo(Producto::class, 'producto_id');
    }
}
