<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Ingrediente;
use App\Models\Producto;
use Illuminate\Http\Request;

class ProductoController extends Controller
{

    protected $fillable = [
        'nombre',
        'descripcion',
        'precio',
        'categoria_id',
        'imagen',
        'personalizable',
        'es_promocion',
    ];

    public function index()
    {
        $productos = Producto::paginate(12);
        $categorias = Categoria::all();
        return view('menu.index', compact('productos', 'categorias'));
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

    public function categoria($slug)
    {
        $categoria = Categoria::where('slug', $slug)->firstOrFail();
        $productos = Producto::where('categoria_id', $categoria->id)->paginate(12);
        $categorias = Categoria::all();
        return view('menu.index', compact('productos', 'categorias', 'categoria'));
    }

    public function modal($id)
    {
        $producto = Producto::findOrFail($id);
        $ingredientes = Ingrediente::where('mostrar', true)->get();
        return view('partials.modal-producto', compact('producto', 'ingredientes'));
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

    public function menu($filter = null)
    {
        $query = Producto::query();

        // Filtros
        switch ($filter) {
            case 'price_asc':
                $query->orderBy('precio', 'asc');
                break;
            case 'price_desc':
                $query->orderBy('precio', 'desc');
                break;
            case 'name_asc':
                $query->orderBy('nombre', 'asc');
                break;
            case 'name_desc':
                $query->orderBy('nombre', 'desc');
                break;
            default:
                $query->orderBy('nombre', 'asc'); // Orden por defecto
                break;
        }

        $productos = $query->paginate(12);
        $categorias = Categoria::all();

        return view('menu.index', compact('productos', 'categorias', 'filter'));
    }
}
