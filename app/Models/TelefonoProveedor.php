<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TelefonoProveedor extends Model
{
    use HasFactory;

    protected $table = 'telefonos_proveedores';
    protected $fillable = ['proveedor_id', 'numero', 'tipo_telefono_id', 'estado_id'];
}