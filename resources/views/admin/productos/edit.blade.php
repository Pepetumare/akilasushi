@extends('layouts.app')

@section('title', 'Editar Producto')

@section('content')
<div class="container py-5">
    <h1 class="fw-bold text-danger mb-4 text-center">Editar Producto</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('productos.update', $producto->id) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')
    
        <!-- Nombre -->
        <div class="mb-3">
            <label class="form-label">Nombre</label>
            <input type="text" name="nombre" value="{{ old('nombre', $producto->nombre) }}" class="form-control" required>
        </div>
    
        <!-- Descripción -->
        <div class="mb-3">
            <label class="form-label">Descripción</label>
            <textarea name="descripcion" class="form-control" rows="3">{{ old('descripcion', $producto->descripcion) }}</textarea>
        </div>
    
        <!-- Precio -->
        <div class="mb-3">
            <label class="form-label">Precio</label>
            <input type="number" name="precio" value="{{ old('precio', $producto->precio) }}" class="form-control" required>
        </div>
    
        <!-- Categoría -->
        <div class="mb-3">
            <label class="form-label">Categoría</label>
            <select name="categoria_id" class="form-select">
                <option value="">Selecciona una categoría</option>
                @foreach($categorias as $categoria)
                    <option value="{{ $categoria->id }}" {{ old('categoria_id', $producto->categoria_id) == $categoria->id ? 'selected' : '' }}>
                        {{ $categoria->nombre }}
                    </option>
                @endforeach
            </select>
        </div>
    
        <!-- Imagen -->
        <div class="mb-3">
            <label class="form-label">Imagen</label>
            <input type="file" name="imagen" class="form-control">
            @if($producto->imagen)
                <div class="mt-2">
                    <img src="{{ asset('storage/' . $producto->imagen) }}" alt="Imagen actual" class="img-thumbnail" style="max-height: 150px;">
                </div>
            @endif
        </div>
    
        <!-- Personalizable -->
        <div class="form-check mb-3">
            <input class="form-check-input" type="checkbox" name="personalizable" id="personalizable"
                {{ old('personalizable', $producto->personalizable) ? 'checked' : '' }}>
            <label class="form-check-label" for="personalizable">
                ¿Es personalizable?
            </label>
        </div>
    
        <!-- Ingredientes -->
        <div class="mb-3">
            <label class="form-label">Ingredientes Disponibles</label>
            <div class="border rounded p-3" style="max-height: 300px; overflow-y: auto;">
                @foreach ($ingredientes as $ingrediente)
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="ingredientes[]" value="{{ $ingrediente->id }}"
                            id="ing{{ $ingrediente->id }}"
                            {{ (is_array(old('ingredientes')) && in_array($ingrediente->id, old('ingredientes'))) || $producto->ingredientes->contains($ingrediente->id) ? 'checked' : '' }}>
                        <label class="form-check-label" for="ing{{ $ingrediente->id }}">
                            {{ $ingrediente->nombre }} ({{ $ingrediente->tipo }})
                        </label>
                    </div>
                @endforeach
            </div>
        </div>
    
        <!-- Botón de guardar -->
        <div class="d-grid">
            <button type="submit" class="btn btn-success">Guardar Producto</button>
        </div>
    </form>
    
</div>
@endsection
