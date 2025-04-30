@extends('layouts.app')

@section('title', 'Administrar Productos')

@section('content')
    <div class="container py-5">
        <h1 class="fw-bold text-danger mb-4 text-center">Productos en Tienda</h1>

        @if (session('success'))
            <div class="alert alert-success text-center">
                {{ session('success') }}
            </div>
        @endif

        <div class="mb-4 text-end">
            <a href="{{ route('productos.create') }}" class="btn btn-primary">➕ Agregar Producto</a>
        </div>

        <div class="table-responsive">
            <table class="table table-bordered align-middle text-center shadow">
                <thead class="table-dark">
                    <tr>
                        <th>Imagen</th>
                        <th>Nombre</th>
                        <th>Precio</th>
                        <th>Categoría</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($productos as $producto)
                        <tr>
                            <td style="width: 100px">
                                @if ($producto->imagen)
                                    <img src="{{ asset('storage/' . $producto->imagen) }}" alt="Imagen del Producto"
                                        class="img-fluid rounded" style="max-height: 150px;">
                                @else
                                    <small class="text-muted">Sin imagen</small>
                                @endif
                            </td>
                            <td>{{ $producto->nombre }}</td>
                            <td>${{ number_format($producto->precio, 0, ',', '.') }}</td>
                            <td>{{ $producto->categoria->nombre ?? '-' }}</td>
                            <td>
                                <a href="{{ route('productos.edit', $producto->id) }}"
                                    class="btn btn-warning btn-sm">Editar</a>
                                <form action="{{ route('productos.destroy', $producto->id) }}" method="POST"
                                    class="d-inline-block"
                                    onsubmit="return confirm('¿Estás seguro de eliminar este producto?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5">No hay productos disponibles.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
