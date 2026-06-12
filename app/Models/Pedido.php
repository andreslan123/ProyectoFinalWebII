<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    use HasFactory;

    protected $table = 'pedidos';

    protected $fillable = ['user_id', 'estado_id', 'fecha_pedido', 'total'];

    // Alias 'usuario' para usar en with(['usuario']) desde el controlador
    public function usuario()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Se mantiene 'user' por si hay código que ya lo usa
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function detalles()
    {
        return $this->hasMany(PedidoDetalle::class);
    }

    public function pagos()
    {
        return $this->hasMany(Pago::class);
    }

    public function envios()
    {
        return $this->hasMany(Envio::class);
    }
}