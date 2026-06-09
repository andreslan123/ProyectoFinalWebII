<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CarritoDetalle extends Model
{
    use HasFactory;

    protected $table = 'carrito_detalles';

    // Columnas permitidas para guardar cuando agreguen cosas al carrito desde la API
    protected $fillable = ['carrito_id', 'producto_id', 'cantidad'];

    // Relación: Cada línea del detalle pertenece a un producto específico
    public function producto()
    {
        return $this->belongsTo(Producto::class);
    }
}
