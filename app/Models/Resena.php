<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Resena extends Model
{
    use HasFactory;

    protected $table = 'resenas';
    protected $fillable = ['producto_id', 'user_id', 'calificacion', 'comentario', 'estado_id'];
}