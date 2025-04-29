<?php

namespace App\Http\Controllers;

use App\Models\Ingrediente;
use Illuminate\Http\Request;

class ArmaTuSushiController extends Controller
{
    public function index()
    {
        $bases = Ingrediente::where('tipo', 'base')->get();
        $proteinas = Ingrediente::where('tipo', 'proteina')->get();
        $vegetales = Ingrediente::where('tipo', 'vegetal')->get();
        $envolturas = Ingrediente::where('tipo', 'envoltura')->get();

        return view('arma.index', compact('bases', 'proteinas', 'vegetales', 'envolturas'));
    }

    public function agregar(Request $request)
    {
        // Validaciones
        $request->validate([
            'base' => 'required|exists:ingredientes,id',
            'proteinas' => 'nullable|array|max:2',  // máximo 2 proteínas
            'proteinas.*' => 'exists:ingredientes,id',
            'vegetales' => 'nullable|array|max:3',  // máximo 3 vegetales
            'vegetales.*' => 'exists:ingredientes,id',
            'envoltura' => 'required|exists:ingredientes,id',
        ], [
            'proteinas.max' => 'Solo puedes seleccionar hasta 2 proteínas.',
            'vegetales.max' => 'Solo puedes seleccionar hasta 3 vegetales.',
        ]);

        // Lógica de armado
        $base = Ingrediente::find($request->base);
        $proteinas = Ingrediente::whereIn('id', $request->proteinas ?? [])->get();
        $vegetales = Ingrediente::whereIn('id', $request->vegetales ?? [])->get();
        $envoltura = Ingrediente::find($request->envoltura);

        $descripcion = "Base: {$base->nombre}, Envoltura: {$envoltura->nombre}";
        if ($proteinas->count()) {
            $descripcion .= ", Proteínas: " . $proteinas->pluck('nombre')->join(', ');
        }
        if ($vegetales->count()) {
            $descripcion .= ", Vegetales: " . $vegetales->pluck('nombre')->join(', ');
        }

        $precio = $base->precio + $envoltura->precio + $proteinas->sum('precio') + $vegetales->sum('precio');

        $cart = session()->get('cart', []);
        $cart[] = [
            "nombre" => "Sushi Personalizado",
            "descripcion" => $descripcion,
            "precio" => $precio,
            "cantidad" => 1,
        ];
        session()->put('cart', $cart);

        return redirect()->route('cart.index')->with('success', '¡Sushi personalizado agregado al carrito!');
    }
}
