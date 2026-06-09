<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;

    protected $table = 'productos';
    protected $fillable = ['nombre', 'descripcion', 'precio_venta', 'codigo_barra', 'marca_id', 'subcategoria_id', 'estado_id'];

    // Relaciones para el Eager Loading del Controller que vimos antes:
    public function subcategoria() { return $this->belongsTo(Subcategoria::class); }
    public function marca() { return $this->belongsTo(Marca::class); }
    public function stock() { return $this->hasOne(StockProducto::class); }
}
