<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Resena extends Model
{
    use HasFactory;

    protected $table = 'resenas';

    const UPDATED_AT = null;

    protected $fillable = [
        'user_id',
        'producto_id',
        'estado_id',
        'calificacion',
        'comentario',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function producto()
    {
        return $this->belongsTo(Producto::class);
    }

    public function estado()
    {
        return $this->belongsTo(EstadoGeneral::class, 'estado_id');
    }
}