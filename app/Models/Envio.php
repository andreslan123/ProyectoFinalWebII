<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Envio extends Model
{
    use HasFactory;

    protected $table = 'envios';

    protected $fillable = [
        'pedido_id', 'estado_id', 'metodo_envio',
        'codigo_seguimiento', 'empresa_envio', 'costo_envio',
        'fecha_envio', 'fecha_entrega'
    ];

    public function pedido()
    {
        return $this->belongsTo(Pedido::class);
    }

    public function estado()
    {
        return $this->belongsTo(EstadoGeneral::class, 'estado_id');
    }
}