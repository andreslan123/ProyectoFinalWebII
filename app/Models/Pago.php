<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pago extends Model
{
    use HasFactory;

    protected $table = 'pagos';

    protected $fillable = ['pedido_id', 'estado_id', 'metodo_pago', 'monto', 'comprobante', 'fecha_pago'];

    public function pedido()
    {
        return $this->belongsTo(Pedido::class);
    }

    public function estado()
    {
        return $this->belongsTo(EstadoGeneral::class, 'estado_id');
    }
}