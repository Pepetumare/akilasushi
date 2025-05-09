<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Combo extends Model
{
    protected $fillable = [
        'producto_id',
        'bloque',
        'ingrediente_id',
        'precio_extra',
    ];

    // Relación con el producto
    public function producto()
    {
        return $this->belongsTo(Producto::class);
    }

    // Relación con el ingrediente
    public function ingrediente()
    {
        return $this->belongsTo(Ingrediente::class);
    }
}
