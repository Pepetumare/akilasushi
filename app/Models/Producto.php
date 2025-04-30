<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    protected $fillable = [
        'nombre',
        'descripcion',
        'precio',
        'categoria_id',
        'imagen',
        'opciones', // si usas opciones json para handrolls
    ];

    public function categoria()
    {
        return $this->belongsTo(Categoria::class);
    }
}
