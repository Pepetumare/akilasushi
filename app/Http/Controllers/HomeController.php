<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Producto;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $promociones = Producto::where('categoria_id', 3)->limit(3)->get(); // Combos
        $categorias = Categoria::all();

        return view('home');
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
