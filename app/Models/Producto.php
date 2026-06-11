<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;

    protected $table = 'productos';

    protected $fillable = [
        'subcategoria_id',
        'marca_id',
        'estado_id',
        'codigo',
        'nombre',
        'descripcion',
        'precio_compra',
        'precio_venta'
    ];

    public function subcategoria()
    {
        return $this->belongsTo(Subcategoria::class);
    }

    public function marca()
    {
        return $this->belongsTo(Marca::class);
    }

    public function stock()
    {
        return $this->hasOne(StockProducto::class);
    }

    public function carritoDetalles()
    {
        return $this->hasMany(CarritoDetalle::class);
    }

    public function pedidoDetalles()
    {
        return $this->hasMany(PedidoDetalle::class);
    }

    public function imagenes()
    {
        return $this->hasMany(ProductoImagen::class);
    }

    public function proveedores()
    {
        return $this->belongsToMany(Proveedor::class, 'producto_proveedor')
            ->withPivot('precio_compra', 'codigo_proveedor', 'principal')
            ->withTimestamps();
    }

    public function promociones()
    {
        return $this->belongsToMany(Promocion::class, 'promocion_productos')
            ->withTimestamps();
    }

    public function resenas()
    {
        return $this->hasMany(Resena::class);
    }

    public function movimientosStock()
    {
        return $this->hasMany(MovimientoStock::class);
    }
}