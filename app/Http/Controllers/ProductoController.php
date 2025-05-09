<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Ingrediente;
use App\Models\Producto;
use Illuminate\Http\Request;

class ProductoController extends Controller
{
    // Método para mostrar el menú principal
    public function index()
    {
        $productos = Producto::paginate(12);
        $categorias = Categoria::all();
        return view('menu.index', compact('productos', 'categorias'));
    }

    // Método para la página de personalización
    public function arma()
    {
        return view('arma.index');
    }

    // Método para mostrar un producto específico
    public function show($id)
    {
        $producto = Producto::findOrFail($id);
        return view('menu.show', compact('producto'));
    }

    // Método para mostrar el detalle de un producto
    public function detalle($id)
    {
        $producto = Producto::findOrFail($id);

        // Verificar si el producto es un combo de 3 hand rolls
        $esCombo3 = str_contains(strtolower($producto->nombre), '3 hand rolls');

        // Obtener ingredientes agrupados por tipo
        $ingredientes = [
            'bases' => Ingrediente::where('tipo', 'base')->get(),
            'proteinas' => Ingrediente::where('tipo', 'proteina')->get(),
            'vegetales' => Ingrediente::where('tipo', 'vegetal')->get(),
            'envolturas' => Ingrediente::where('tipo', 'envoltura')->get(),
        ];

        return view('menu.detalle', compact('producto', 'ingredientes', 'esCombo3'));
    }

    // Método para filtrar productos por categoría
    public function categoria($slug)
    {
        $categoria = Categoria::where('slug', $slug)->firstOrFail();
        $productos = Producto::where('categoria_id', $categoria->id)->paginate(12);
        $categorias = Categoria::all();
        return view('menu.index', compact('productos', 'categorias', 'categoria'));
    }

    // Método para mostrar el modal de un producto
    public function modal($id)
    {
        $producto = Producto::findOrFail($id);
        $ingredientes = Ingrediente::where('mostrar', true)->get();
        return view('partials.modal-producto', compact('producto', 'ingredientes'));
    }

    // Método para agregar un producto personalizado al carrito
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

    // Método para agregar un producto estándar al carrito
    public function add(Request $request, $id)
    {
        $producto = Producto::findOrFail($id);
        $cart = session()->get('cart', []);
        $ingredientes = $request->input('ingredientes', []);
        $precio_final = $request->input('precio_final', $producto->precio);

        // Crear un identificador único considerando el producto y los ingredientes
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
}
