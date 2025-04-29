<?php

namespace App\Http\Controllers;

use App\Models\Ingrediente;
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

    public function detalle($id)
    {
        $producto = Producto::findOrFail($id);

        // Detectamos si es combo: nombre contiene "hand roll"
        $esCombo3 = str_contains(strtolower($producto->nombre), '3 hand rolls');

        $ingredientes = [
            'bases' => Ingrediente::where('tipo', 'base')->get(),
            'proteinas' => Ingrediente::where('tipo', 'proteina')->get(),
            'vegetales' => Ingrediente::where('tipo', 'vegetal')->get(),
            'envolturas' => Ingrediente::where('tipo', 'envoltura')->get(),
        ];

        return view('menu.detalle', compact('producto', 'ingredientes', 'esCombo3'));
    }

    public function agregarPersonalizado(Request $request, $id)
    {
        $producto = Producto::findOrFail($id);
        $cart = session()->get('cart', []);

        $items = [];

        if ($request->has('combo')) {
            foreach ($request->input('combo') as $index => $item) {
                $base = 'Queso crema' . (isset($item['sin_cebollin']) ? '' : ' y cebollín');

                $descripcion = "Hand Roll " . ($index + 1) . ": Base $base, Proteína {$item['proteina']}, Vegetal {$item['vegetal']}, Envoltura {$item['envoltura']}";

                $items[] = $descripcion;
            }
        }

        $cart[] = [
            "nombre" => $producto->nombre,
            "descripcion" => implode(' | ', $items),
            "precio" => $producto->precio,
            "cantidad" => 1,
        ];

        session()->put('cart', $cart);

        return redirect()->route('cart.index')->with('success', 'Producto personalizado agregado al carrito');
    }
}
