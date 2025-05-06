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
        // Validación básica
        $request->validate([
            'base' => 'required|exists:ingredientes,id',
            'ingredientes' => 'required|array|min:1|max:3',
            'ingredientes.*' => 'exists:ingredientes,id',
            'envoltura' => 'required|exists:ingredientes,id',
        ]);

        // Obtener ingredientes desde BD
        $base = Ingrediente::find($request->base);
        $envoltura = Ingrediente::find($request->envoltura);
        $ingredientesSeleccionados = Ingrediente::whereIn('id', $request->ingredientes)->get();

        // Reglas de negocio del cliente
        $ingredientes = [];
        $precioTotal = $base->precio + $envoltura->precio;
        $contador = [];

        foreach ($ingredientesSeleccionados as $ing) {
            $contador[$ing->nombre] = ($contador[$ing->nombre] ?? 0) + 1;

            if ($ing->nombre === 'Salmón' && $contador[$ing->nombre] > 1) {
                return back()->with('error', 'No puedes repetir salmón.');
            }

            $precioExtra = 0;
            $repeticiones = $contador[$ing->nombre];

            // Aplica precio extra por repetición
            if ($repeticiones > 1 && $ing->nombre !== 'Salmón') {
                $precioExtra += ($repeticiones - 1) * 1000;
            }

            // Aplica cargo por tipo especial
            if (str_contains(strtolower($ing->nombre), 'apanado')) {
                $precioExtra += 1500;
            } elseif (strtolower($ing->nombre) === 'carne') {
                $precioExtra += 2000;
            }

            $precioFinal = $ing->precio + $precioExtra;
            $precioTotal += $precioFinal;

            $ingredientes[] = [
                'id' => $ing->id,
                'nombre' => $ing->nombre,
                'precio_unitario' => $ing->precio,
                'repeticiones' => $repeticiones,
                'precio_final' => $precioFinal
            ];
        }

        // Armar descripción
        $descripcion = "Base: {$base->nombre}, Envoltura: {$envoltura->nombre}, Ingredientes: " .
            collect($ingredientes)->pluck('nombre')->join(', ');

        // Guardar en carrito
        $cart = session()->get('cart', []);
        $cart[] = [
            "nombre" => "Hand Roll Personalizado",
            "descripcion" => $descripcion,
            "ingredientes" => $ingredientes,
            "precio" => $precioTotal,
            "cantidad" => 1,
        ];
        session()->put('cart', $cart);

        return redirect()->route('cart.index')->with('success', '¡Hand roll personalizado agregado al carrito!');
    }
}
