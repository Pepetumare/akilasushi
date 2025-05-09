<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use App\Models\Combo;
use Illuminate\Http\Request;

class CartController extends Controller
{
    // Mostrar el carrito de compras
    public function index()
    {
        $cart = session()->get('cart', []);
        $total = array_sum(array_map(function ($item) {
            return $item['precio'] * $item['cantidad'];
        }, $cart));

        return view('cart.index', compact('cart', 'total'));
    }

    // Agregar un producto al carrito
    public function add(Request $request, $id)
    {
        $producto = Producto::findOrFail($id);
        $cart = session()->get('cart', []);

        // Obtener ingredientes y precio actualizado del request
        $ingredientes = $request->input('ingredientes', []);
        $precio_final = $request->input('precio_final', $producto->precio);

        // Generar un hash único considerando el producto y los ingredientes
        $hash = md5($producto->id . json_encode($ingredientes));

        if (isset($cart[$hash])) {
            $cart[$hash]['cantidad']++;
        } else {
            $cart[$hash] = [
                "nombre" => $producto->nombre,
                "precio" => (int) $precio_final,
                "cantidad" => 1,
                "ingredientes" => $ingredientes,
            ];
        }

        session()->put('cart', $cart);

        return redirect()->back()->with('success', 'Producto agregado al carrito');
    }

    // Agregar un combo personalizado al carrito
    public function addCombo(Request $request, $id)
    {
        $producto = Producto::findOrFail($id);
        $cart = session()->get('cart', []);
        $items = [];

        foreach ($request->combos as $combo) {
            $ingrediente = Combo::find($combo['ingrediente_id']);
            $descripcion = "Bloque {$combo['bloque']}: " . $ingrediente->nombre;
            $precio_extra = $ingrediente->precio_repeticion ?? 0;

            $items[] = [
                "descripcion" => $descripcion,
                "precio_extra" => $precio_extra,
            ];
        }

        $hash = md5($producto->id . json_encode($items));

        if (isset($cart[$hash])) {
            $cart[$hash]['cantidad']++;
        } else {
            $cart[$hash] = [
                "nombre" => $producto->nombre,
                "descripcion" => implode(' | ', array_column($items, 'descripcion')),
                "precio" => $producto->precio + array_sum(array_column($items, 'precio_extra')),
                "cantidad" => 1,
            ];
        }

        session()->put('cart', $cart);
        return redirect()->route('cart.index')->with('success', 'Combo personalizado agregado al carrito');
    }

    // Eliminar un producto del carrito
    public function remove($id)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            unset($cart[$id]);
            session()->put('cart', $cart);
        }

        return redirect()->route('cart.index')->with('success', 'Producto eliminado del carrito');
    }

    // Vaciar el carrito
    public function clear()
    {
        session()->forget('cart');
        return redirect()->route('cart.index')->with('success', 'Carrito vaciado');
    }
}
