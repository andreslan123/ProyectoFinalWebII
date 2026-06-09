<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    // Le decimos explícitamente qué tabla mapear
    protected $table = 'users';

    // Tus campos de asignación masiva ordenados
    protected $fillable = [
        'rol_id',
        'estado_id',
        'name',
        'email',
        'password'
    ];

    // Oculta la contraseña cuando la API responda con un JSON de usuarios
    protected $hidden = [
        'password',
        'remember_token', // Añádelo por si tu migración o factory lo usan
    ];

    // Como pusiste que no usas timestamps, Laravel no buscará 'created_at' ni 'updated_at'
    public $timestamps = false;
}
