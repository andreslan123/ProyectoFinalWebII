<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StockProducto extends Model
{
    use HasFactory;

    protected $table = 'stock_productos';

    public $timestamps = false;

    protected $fillable = [
        'producto_id',
        'cantidad_actual',
        'stock_minimo',
    ];

    public function producto()
    {
        return $this->belongsTo(Producto::class);
    }
}