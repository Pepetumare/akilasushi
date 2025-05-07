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

        {{-- <div class="mb-4 text-end">
            <a href="{{ route('productos.create') }}" class="btn btn-primary">➕ Agregar Producto</a>
        </div> --}}


        <div class="container">
            <!-- Botón para abrir el modal -->
            <button class="btn btn-success mb-3" data-bs-toggle="modal" data-bs-target="#crearProductoModal">
                <i class="bi bi-plus-circle fixed-top"></i> Crear Producto
            </button>
        </div>


        <div class="table-responsive">
            <table class="table table-bordered text-center align-middle">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Categoría</th>
                        <th>Precio</th>
                        <th>¿Promoción?</th>
                        <th>Imagen</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($productos as $producto)
                        <tr>
                            <td>{{ $producto->id }}</td>
                            <td>{{ $producto->nombre }}</td>
                            <td>{{ $producto->categoria->nombre ?? 'Sin categoría' }}</td>
                            <td>${{ number_format($producto->precio, 0, ',', '.') }}</td>
                            <td>
                                @if ($producto->es_promocion)
                                    <span class="badge bg-success">Sí</span>
                                @else
                                    <span class="badge bg-secondary">No</span>
                                @endif
                            </td>
                            <td>
                                @if ($producto->imagen)
                                    <img src="{{ asset('storage/' . $producto->imagen) }}" alt="Imagen del producto"
                                        style="height: 60px;">
                                @else
                                    <span class="text-muted">Sin imagen</span>
                                @endif
                            </td>
                            <td>
                                <!-- BOTÓN EDITAR -->
                                <button class="btn btn-warning btn-sm btn-editar" data-id="{{ $producto->id }}"
                                    data-nombre="{{ $producto->nombre }}" data-descripcion="{{ $producto->descripcion }}"
                                    data-precio="{{ $producto->precio }}" data-categoria_id="{{ $producto->categoria_id }}"
                                    data-ingredientes='@json($producto->ingredientes->pluck('id'))' data-bs-toggle="modal"
                                    data-bs-target="#modalEditar">
                                    Editar
                                </button>


                                <form action="{{ route('productos.destroy', $producto->id) }}" method="POST"
                                    class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger"
                                        onclick="return confirm('¿Estás seguro de eliminar este producto?')">Eliminar</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <!-- Modal Editar Producto -->
            <div class="modal fade" id="modalEditar" tabindex="-1" aria-labelledby="modalEditarLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content shadow">
                        <div class="modal-header bg-warning text-dark">
                            <h5 class="modal-title" id="modalEditarLabel">Editar Producto</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                        </div>
                        <div class="modal-body">
                            <form method="POST" action="" id="formEditar" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')

                                <div class="mb-3">
                                    <label class="form-label">Nombre</label>
                                    <input type="text" name="nombre" class="form-control" required>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Descripción</label>
                                    <textarea name="descripcion" class="form-control" rows="2"></textarea>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Precio</label>
                                    <input type="number" name="precio" class="form-control" required>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Categoría</label>
                                    <select name="categoria_id" class="form-select" required>
                                        @foreach ($categorias as $categoria)
                                            <option value="{{ $categoria->id }}">{{ $categoria->nombre }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <!-- Campo de imagen -->
                                <div class="mb-3">
                                    <label for="imagen" class="form-label">Imagen del Producto</label>
                                    <input type="file" name="imagen" class="form-control" id="imagen">
                                    @if ($producto->imagen)
                                        <img src="{{ $producto->imagen_url }}" alt="Imagen actual"
                                            class="img-thumbnail mt-2" style="max-height: 150px;">
                                    @endif
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Ingredientes</label>
                                    <div class="border rounded p-2" style="max-height: 200px; overflow-y:auto;">
                                        @foreach ($ingredientes as $ingrediente)
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="ingredientes[]"
                                                    value="{{ $ingrediente->id }}" id="ing{{ $ingrediente->id }}">
                                                <label class="form-check-label" for="ing{{ $ingrediente->id }}">
                                                    {{ $ingrediente->nombre }} ({{ $ingrediente->tipo }})
                                                </label>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>

                                <div class="d-grid">
                                    <button type="submit" class="btn btn-success">Guardar Cambios</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>



        </div>
    </div>
    <!-- Modal Crear Producto -->
    <div class="modal fade" id="crearProductoModal" tabindex="-1" aria-labelledby="crearProductoModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content shadow">
                <div class="modal-header bg-dark text-white">
                    <h5 class="modal-title" id="crearProductoModalLabel">Crear Nuevo Producto</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                        aria-label="Cerrar"></button>
                </div>
                <div class="modal-body">
                    @include('admin.productos._form', [
                        'producto' => null,
                        'categorias' => $categorias,
                        'ingredientes' => $ingredientes,
                    ])
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const editarModal = document.getElementById('modalEditar');
                const form = editarModal.querySelector('form');

                document.querySelectorAll('.btn-editar').forEach(boton => {
                    boton.addEventListener('click', function() {
                        // Rellenar campos
                        form.action =
                            `/admin/productos/${this.dataset.id}`; // Ajusta si usas named routes
                        form.querySelector('[name="nombre"]').value = this.dataset.nombre;
                        form.querySelector('[name="descripcion"]').value = this.dataset.descripcion;
                        form.querySelector('[name="precio"]').value = this.dataset.precio;

                        // Seleccionar la categoría
                        form.querySelector('[name="categoria_id"]').value = this.dataset.categoria_id;

                        // Limpiar y marcar ingredientes
                        const checkboxes = form.querySelectorAll('input[name="ingredientes[]"]');
                        checkboxes.forEach(c => c.checked = false);

                        const ingredientes = JSON.parse(this.dataset.ingredientes || '[]');
                        ingredientes.forEach(id => {
                            const checkbox = form.querySelector(
                                `input[name="ingredientes[]"][value="${id}"]`);
                            if (checkbox) checkbox.checked = true;
                        });
                    });
                });
            });
        </script>
    @endpush

@endsection
