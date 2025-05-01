<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        $cart = session()->get('cart', []);
        $total = array_sum(array_map(function ($item) {
            return $item['precio'] * $item['cantidad'];
        }, $cart));

        return view('cart.index', compact('cart', 'total'));
    }

    public function add(Request $request, $id)
    {
        $producto = Producto::findOrFail($id);
        $cart = session()->get('cart', []);
    
        $ingredientes = $request->input('ingredientes') ? json_decode($request->input('ingredientes'), true) : [];
        $precioFinal = $request->input('precio_final') ?? $producto->precio;
    
        // generar un hash único si es personalizado
        $hash = md5($id . json_encode($ingredientes) . $precioFinal);
    
        if (isset($cart[$hash])) {
            $cart[$hash]['cantidad']++;
        } else {
            $cart[$hash] = [
                "producto_id" => $id,
                "nombre" => $producto->nombre,
                "ingredientes" => $ingredientes,
                "precio" => (int) $precioFinal,
                "cantidad" => 1,
            ];
        }
    
        session()->put('cart', $cart);
    
        return redirect()->back()->with('success', 'Producto agregado al carrito');
    }
    


    public function remove($id)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            unset($cart[$id]);
            session()->put('cart', $cart);
        }

        return redirect()->route('cart.index')->with('success', 'Producto eliminado del carrito');
    }

    public function checkout()
    {
        $cart = session()->get('cart', []);
        $total = array_sum(array_map(function ($item) {
            return $item['precio'] * $item['cantidad'];
        }, $cart));

        return view('cart.checkout', compact('cart', 'total'));
    }
}
