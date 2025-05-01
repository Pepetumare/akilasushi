@extends('layouts.app')

@section('title', 'Agregar Producto')

@section('content')
<div class="container py-5">
    <h1 class="fw-bold text-danger mb-4 text-center">Agregar Nuevo Producto</h1>

    <div class="row justify-content-center">
        <div class="col-md-8">

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="card shadow">
                <div class="card-body">
                    <form method="POST" action="{{ route('productos.store') }}" enctype="multipart/form-data">
                        @csrf

                        <!-- Nombre -->
                        <div class="mb-3">
                            <label class="form-label">Nombre del Producto</label>
                            <input type="text" name="nombre" class="form-control" value="{{ old('nombre') }}" required>
                        </div>

                        <!-- Descripción -->
                        <div class="mb-3">
                            <label class="form-label">Descripción (opcional)</label>
                            <textarea name="descripcion" class="form-control" rows="3">{{ old('descripcion') }}</textarea>
                        </div>

                        <!-- Precio -->
                        <div class="mb-3">
                            <label class="form-label">Precio (CLP)</label>
                            <input type="number" name="precio" class="form-control" value="{{ old('precio') }}" required min="0">
                        </div>

                        <!-- Categoría -->
                        <div class="mb-3">
                            <label class="form-label">Categoría</label>
                            <select name="categoria_id" class="form-select">
                                <option value="">Selecciona una categoría</option>
                                @foreach($categorias as $categoria)
                                    <option value="{{ $categoria->id }}" {{ old('categoria_id') == $categoria->id ? 'selected' : '' }}>
                                        {{ $categoria->nombre }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Imagen -->
                        <div class="mb-4">
                            <label class="form-label">Imagen del Producto (opcional)</label>
                            <input type="file" name="imagen" class="form-control" accept="image/*">
                        </div>
                        <div class="form-check mb-3">
                            <input class="form-check-input" type="checkbox" name="es_promocion" id="es_promocion"
                                {{ old('es_promocion', $producto->es_promocion ?? false) ? 'checked' : '' }}>
                            <label class="form-check-label" for="es_promocion" name="es_promocion">
                                Mostrar este producto como promoción destacada
                            </label>
                        </div>
                        
                        
                        <!-- Botones -->
                        <div class="d-flex justify-content-between">
                            <a href="{{ route('productos.index') }}" class="btn btn-secondary">Cancelar</a>
                            <button type="submit" class="btn btn-success">Guardar Producto</button>
                        </div>

                    </form>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
