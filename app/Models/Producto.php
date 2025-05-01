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
        'personalizable',
        'es_promocion', // 👈 ¡ESTO ES OBLIGATORIO!
    ];
    

    public function categoria()
    {
        return $this->belongsTo(Categoria::class);
    }
}
