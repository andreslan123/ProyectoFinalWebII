<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EstadoGeneral extends Model
{
    use HasFactory;

    protected $table = 'estados_general';

    public $timestamps = false;

    protected $fillable = [
        'tipo',
        'nombre',
    ];
}