<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Promocion extends Model
{
    use HasFactory;

    protected $table = 'promociones';

    public $timestamps = false;

    protected $fillable = [
        'estado_id',
        'tipo_descuento',
        'titulo',
        'descripcion',
        'valor_descuento',
        'fecha_inicio',
        'fecha_fin',
    ];

    public function estado()
    {
        return $this->belongsTo(EstadoGeneral::class, 'estado_id');
    }

    public function productos()
    {
        return $this->belongsToMany(Producto::class, 'promocion_productos');
    }
}