<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TelefonoProveedor extends Model
{
    use HasFactory;

    protected $table = 'telefonos_proveedores';

    public $timestamps = false;

    protected $fillable = [
        'proveedor_id',
        'tipo_telefono_id',
        'numero',
        'principal',
    ];

    public function proveedor()
    {
        return $this->belongsTo(Proveedor::class);
    }

    public function tipoTelefono()
    {
        return $this->belongsTo(TipoTelefono::class, 'tipo_telefono_id');
    }
}