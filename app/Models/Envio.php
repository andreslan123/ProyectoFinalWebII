<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Envio extends Model
{
    use HasFactory;

    protected $table = 'envios';
    protected $fillable = ['pedido_id', 'direccion_destino', 'codigo_seguimiento', 'empresa_transporte', 'fecha_envio', 'fecha_entrega', 'estado_id'];
}
