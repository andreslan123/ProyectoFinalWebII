<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Carrito extends Model
{
    use HasFactory;

    protected $table = 'carritos';
    
    // Solo permitimos llenar de forma masiva el ID del usuario dueño del carrito
    protected $fillable = ['user_id'];

    // Relación: Un carrito tiene muchos detalles (productos adentro)
    public function detalles()
    {
        return $this->hasMany(CarritoDetalle::class);
    }
}
