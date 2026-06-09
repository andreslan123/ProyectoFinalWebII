<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    use HasFactory;

    protected $table = 'pedidos';
    protected $fillable = ['user_id', 'fecha_pedido', 'total', 'estado_id'];

    // Relación por si luego necesitas ver los detalles desde el pedido
    public function detalles() { return $this->hasMany(PedidoDetalle::class); }
}
