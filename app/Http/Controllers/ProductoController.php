<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use Illuminate\Http\Request;

class ProductoController extends Controller
{
    public function index()
    {
        $productos = Producto::all();
        return view('menu.index', compact('productos'));
    }

    public function arma()
    {
        // Aquí luego agregaremos la lógica de personalización
        return view('arma.index');
    }

    public function show($id)
    {
        $producto = Producto::findOrFail($id);
        return view('menu.show', compact('producto'));
    }
}
