<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Producto;
use App\Models\Categoria;
use App\Models\Ingrediente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;


class ProductoAdminController extends Controller
{
    public function index()
    {
        $productos = Producto::with('categoria')->get();
        return view('admin.productos.index', compact('productos'));
    }

    public function create()
    {
        $categorias = Categoria::all();
        $ingredientes = Ingrediente::all();
        return view('admin.productos.create', compact('categorias', 'ingredientes'));
    }


    public function store(Request $request)
    {
        $data = $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'precio' => 'required|numeric|min:0',
            'categoria_id' => 'nullable|exists:categorias,id',
            'imagen' => 'nullable|image|max:2048',
            'es_promocion' => 'nullable|in:on,1,true,false,0',
        ]);
    
        $data['es_promocion'] = $request->has('es_promocion');
        $data['personalizable'] = $request->has('personalizable');
    
        if ($request->hasFile('imagen')) {
            $nombreOriginal = $request->file('imagen')->getClientOriginalName();
            $fecha = now()->format('Ymd_His');
            $nombreFinal = $fecha . '_' . Str::slug(pathinfo($nombreOriginal, PATHINFO_FILENAME)) . '.' . $request->file('imagen')->extension();
            $data['imagen'] = $request->file('imagen')->storeAs('productos', $nombreFinal, 'public');
        }
    
        $producto = Producto::create($data);
    
        // 🔁 Relacionar ingredientes seleccionados
        if ($request->filled('ingredientes')) {
            $producto->ingredientes()->sync($request->ingredientes);
        }
    
        return redirect()->route('productos.index')->with('success', 'Producto creado correctamente');
    }
    

    public function edit(Producto $producto)
    {
        $categorias = Categoria::all();
        $ingredientes = Ingrediente::all();
        return view('admin.productos.edit', compact('producto', 'categorias', 'ingredientes'));
    }

    
    public function update(Request $request, Producto $producto)
    {
        $data = $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'precio' => 'required|numeric|min:0',
            'categoria_id' => 'nullable|exists:categorias,id',
            'imagen' => 'nullable|image|max:2048',
            'es_promocion' => 'nullable|in:on,1,true,false,0',
        ]);
    
        $data['es_promocion'] = $request->has('es_promocion');
        $data['personalizable'] = $request->has('personalizable');
    
        if ($request->hasFile('imagen')) {
            if ($producto->imagen) {
                Storage::disk('public')->delete($producto->imagen);
            }
    
            $nombreOriginal = $request->file('imagen')->getClientOriginalName();
            $fecha = now()->format('Ymd_His');
            $nombreFinal = $fecha . '_' . Str::slug(pathinfo($nombreOriginal, PATHINFO_FILENAME)) . '.' . $request->file('imagen')->extension();
    
            $data['imagen'] = $request->file('imagen')->storeAs('productos', $nombreFinal, 'public');
        }
    
        $producto->update($data);
    
        // 🔁 Sincronizar ingredientes
        $producto->ingredientes()->sync($request->ingredientes ?? []);
    
        return redirect()->route('productos.index')->with('success', 'Producto actualizado correctamente');
    }
    

    public function destroy(Producto $producto)
    {
        if ($producto->imagen) {
            Storage::disk('public')->delete($producto->imagen);
        }

        $producto->delete();

        return redirect()->route('productos.index')->with('success', 'Producto eliminado');
    }
}
