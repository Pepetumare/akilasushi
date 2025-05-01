<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ingrediente extends Model
{
    public function productos()
    {
        return $this->belongsToMany(Producto::class, 'producto_ingrediente');
    }
}
