<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TelefonoUsuario extends Model
{
    use HasFactory;

    protected $table = 'telefonos_usuarios';

    public $timestamps = false;

    protected $fillable = [
        'user_id',
        'tipo_telefono_id',
        'numero',
        'estado_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function tipoTelefono()
    {
        return $this->belongsTo(TipoTelefono::class, 'tipo_telefono_id');
    }
}