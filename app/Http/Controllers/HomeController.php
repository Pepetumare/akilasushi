<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Producto;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $promociones = Producto::where('es_promocion', true)->limit(3)->get();
        $categorias = Categoria::all();

        return view('home', compact('promociones', 'categorias'));
    }

    public function locales()
    {
        return view('locales.index');
    }

    public function contacto()
    {
        return view('contacto.index');
    }
}
