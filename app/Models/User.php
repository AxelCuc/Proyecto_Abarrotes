<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * Nombre de la tabla asociada al modelo.
     */
    protected $table = 'usuarios';

    /**
     * Campos que se pueden asignar masivamente.
     */
    protected $fillable = [
        'nombre',
        'email',     // 🔧 corregido: antes tenías 'correo', debe ser 'email' para coincidir con la validación y autenticación
        'password',
        'rol_id',
    ];

    /**
     * Campos ocultos al serializar.
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Casts de atributos.
     */
    protected $casts = [
        'password' => 'hashed',
        'email_verified_at' => 'datetime',
    ];

    /**
     * Relación: obtener el rol asociado al usuario.
     */
    public function rol()
    {
        return $this->belongsTo(Role::class, 'rol_id');
    }

    /**
     * Ventas registradas por este usuario (cajero/admin).
     */
    public function ventas()
    {
        return $this->hasMany(\App\Models\Venta::class, 'usuario_id');
    }
}
