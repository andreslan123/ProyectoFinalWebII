<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pago extends Model
{
    use HasFactory;

    protected $table = 'pagos';
    protected $fillable = ['pedido_id', 'monto', 'fecha_pago', 'metodo_pago', 'comprobante_url', 'estado_id'];
}
