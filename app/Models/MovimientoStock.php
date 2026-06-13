<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MovimientoStock extends Model
{
    use HasFactory;

    protected $table = 'movimientos_stock';

    public $timestamps = false;

    protected $fillable = [
        'producto_id',
        'tipo_movimiento',
        'cantidad',
        'motivo',
        'fecha_movimiento',
    ];

    public function producto()
    {
        return $this->belongsTo(Producto::class);
    }

    public function tipoMovimiento()
    {
        return $this->belongsTo(EstadoGeneral::class, 'tipo_movimiento_id');
    }
}