<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PedidoDetalle extends Model
{
    use HasFactory;

    protected $table = 'pedido_detalles';
    protected $fillable = ['pedido_id', 'producto_id', 'cantidad', 'precio_unitario', 'subtotal'];
}
