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

        <div class="mb-3">
            <label class="form-label">Nombre</label>
            <input type="text" name="nombre" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Descripción</label>
            <textarea name="descripcion" class="form-control" rows="3"></textarea>
        </div>

        <div class="mb-3">
            <label class="form-label">Precio</label>
            <input type="number" name="precio" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Categoría</label>
            <select name="categoria_id" class="form-select">
                <option value="">Selecciona una categoría</option>
                @foreach($categorias as $categoria)
                    <option value="{{ $categoria->id }}">{{ $categoria->nombre }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Imagen</label>
            <input type="file" name="imagen" class="form-control">
        </div>

        <div class="form-check mb-3">
            <input class="form-check-input" type="checkbox" name="personalizable" id="personalizable">
            <label class="form-check-label" for="personalizable">
                ¿Es personalizable?
            </label>
        </div>

        <div class="mb-3">
            <label class="form-label">Ingredientes Disponibles</label>
            <div class="border rounded p-3" style="max-height: 300px; overflow-y: auto;">
                @foreach ($ingredientes as $ingrediente)
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="ingredientes[]" value="{{ $ingrediente->id }}" {{ $producto->ingredientes->contains($ingrediente->id) ? "checked" : "" }} id="ing{{ $ingrediente->id }}">
                        <label class="form-check-label" for="ing{{ $ingrediente->id }}">
                            {{ $ingrediente->nombre }} ({{ $ingrediente->tipo }})
                        </label>
                    </div>
                @endforeach
            </div>
        </div>

        <div class="d-grid">
            <button type="submit" class="btn btn-success">Guardar Producto</button>
        </div>
    </form>
</div>
@endsection
