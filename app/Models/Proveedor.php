<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proveedor extends Model
{
    use HasFactory;

    protected $table = 'proveedores';

    public $timestamps = false;

    protected $fillable = [
        'estado_id',
        'nombre_empresa',
        'nit',
        'correo',
        'direccion',
    ];

    public function estado()
    {
        return $this->belongsTo(EstadoGeneral::class, 'estado_id');
    }

    public function telefonos()
    {
        return $this->hasMany(TelefonoProveedor::class);
    }

    public function productos()
    {
        return $this->belongsToMany(Producto::class, 'producto_proveedor')
            ->withPivot('precio_compra', 'codigo_proveedor', 'principal');
    }
}