<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'users';

    protected $fillable = [
        'rol_id',
        'estado_id',
        'name',
        'apellido_paterno',
        'apellido_materno',
        'ci',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];
<<<<<<< HEAD
    public $timestamps = false;
}
=======

    public function rol()
    {
        return $this->belongsTo(Rol::class, 'rol_id');
    }

    public function estado()
    {
        return $this->belongsTo(EstadoGeneral::class, 'estado_id');
    }

    public function carritos()
    {
        return $this->hasMany(Carrito::class);
    }

    public function pedidos()
    {
        return $this->hasMany(Pedido::class);
    }

    public function resenas()
    {
        return $this->hasMany(Resena::class);
    }
}
>>>>>>> 934b512a9c5e297e79b3d75d2833a1af769e596d
