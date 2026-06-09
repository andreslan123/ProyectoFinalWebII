<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MovimientoStock extends Model
{
    use HasFactory;

    protected $table = 'movimientos_stock';
    protected $fillable = ['producto_id', 'tipo_movimiento', 'cantidad', 'descripcion', 'user_id'];
}
