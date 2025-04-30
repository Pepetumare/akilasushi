<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Producto;

class AdminController extends Controller
{
    public function dashboard()
    {
        $totalProductos = Producto::count();
        $pedidosHoy = 0; // reemplazar luego con lógica real
        $ventasTotales = 0; // reemplazar luego con lógica real

        return view('admin.dashboard', compact('totalProductos', 'pedidosHoy', 'ventasTotales'));
    }
}
