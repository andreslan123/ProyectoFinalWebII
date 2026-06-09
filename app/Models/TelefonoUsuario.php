<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TelefonoUsuario extends Model
{
    use HasFactory;

    protected $table = 'telefonos_usuarios';
    protected $fillable = ['user_id', 'numero', 'tipo_telefono_id', 'estado_id'];
}
