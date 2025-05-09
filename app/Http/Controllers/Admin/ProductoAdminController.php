<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Producto;
use App\Models\Categoria;
use App\Models\Ingrediente;
use App\Models\Combo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProductoAdminController extends Controller
{
    // Mostrar lista de productos en el panel administrativo
    public function index()
    {
        $productos = Producto::with('categoria')->get();
        $categorias = Categoria::all();
        return view('admin.productos.index', compact('productos', 'categorias'));
    }

    // Crear un nuevo producto
    public function create()
    {
        $categorias = Categoria::all();
        $ingredientes = Ingrediente::all();
        return view('admin.productos.create', compact('categorias', 'ingredientes'));
    }

    // Guardar el nuevo producto en la base de datos
    public function store(Request $request)
    {
        $data = $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'precio' => 'required|numeric|min:0',
            'categoria_id' => 'nullable|exists:categorias,id',
            'imagen' => 'nullable|image|max:2048',
            'es_promocion' => 'nullable|boolean',
            'personalizable' => 'nullable|boolean',
        ]);

        if ($request->hasFile('imagen')) {
            $data['imagen'] = $request->file('imagen')->store('productos', 'public');
        }

        $producto = Producto::create($data);

        // Si es personalizado, agregar combos
        if ($request->has('combos')) {
            foreach ($request->input('combos') as $combo) {
                Combo::create([
                    'producto_id' => $producto->id,
                    'bloque' => $combo['bloque'],
                    'ingrediente_id' => $combo['ingrediente_id'],
                    'precio_extra' => $combo['precio_extra'] ?? 0,
                ]);
            }
        }

        return redirect()->route('admin.productos.index')->with('success', 'Producto creado correctamente');
    }

    // Editar un producto existente
    public function edit($id)
    {
        $producto = Producto::with('combos')->findOrFail($id);
        $categorias = Categoria::all();
        $ingredientes = Ingrediente::all();
        return view('admin.productos.edit', compact('producto', 'categorias', 'ingredientes'));
    }

    // Actualizar el producto en la base de datos
    public function update(Request $request, $id)
    {
        $producto = Producto::findOrFail($id);

        $data = $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'precio' => 'required|numeric|min:0',
            'categoria_id' => 'nullable|exists:categorias,id',
            'imagen' => 'nullable|image|max:2048',
            'es_promocion' => 'nullable|boolean',
            'personalizable' => 'nullable|boolean',
        ]);

        if ($request->hasFile('imagen')) {
            if ($producto->imagen) {
                Storage::disk('public')->delete($producto->imagen);
            }
            $data['imagen'] = $request->file('imagen')->store('productos', 'public');
        }

        $producto->update($data);

        // Actualizar combos personalizados
        Combo::where('producto_id', $producto->id)->delete();
        if ($request->has('combos')) {
            foreach ($request->input('combos') as $combo) {
                Combo::create([
                    'producto_id' => $producto->id,
                    'bloque' => $combo['bloque'],
                    'ingrediente_id' => $combo['ingrediente_id'],
                    'precio_extra' => $combo['precio_extra'] ?? 0,
                ]);
            }
        }

        return redirect()->route('admin.productos.index')->with('success', 'Producto actualizado correctamente');
    }

    // Eliminar un producto
    public function destroy($id)
    {
        $producto = Producto::findOrFail($id);

        if ($producto->imagen) {
            Storage::disk('public')->delete($producto->imagen);
        }

        $producto->delete();
        return redirect()->route('admin.productos.index')->with('success', 'Producto eliminado');
    }
}
