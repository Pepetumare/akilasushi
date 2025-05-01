@extends('layouts.app')

@section('title', isset($categoria) ? $categoria->nombre . ' - Menú' : 'Menú - Sushi Akila')

@section('content')
    <style>
        .filtro-activo {
            background-color: #dc3545 !important;
            color: white !important;
            font-weight: bold;
        }

        .card-producto {
            transition: transform 0.2s;
        }

        .card-producto:hover {
            transform: scale(1.03);
            box-shadow: 0 0 15px rgba(220, 53, 69, 0.3);
        }

        .titulo-japones {
            font-family: 'Noto Serif JP', serif;
            font-weight: 700;
            color: #dc3545;
            border-left: 6px solid #dc3545;
            padding-left: 15px;
            margin-bottom: 30px;
        }

        .list-group-item:hover {
            background-color: #ffe5e5;
            color: #dc3545;
        }
    </style>

    <div class="container py-5">
        <div class="row">
            {{-- FILTROS DE CATEGORÍA --}}
            <div class="col-md-3 mb-4">
                <h5 class="titulo-japones">Categorías</h5>
                <div class="list-group shadow-sm">
                    <a href="{{ route('menu') }}"
                        class="list-group-item list-group-item-action {{ !isset($categoria) ? 'filtro-activo' : '' }}">
                        🍣 Todas
                    </a>
                    @foreach ($categorias as $cat)
                        <a href="{{ route('menu.categoria', $cat->slug) }}"
                            class="list-group-item list-group-item-action {{ isset($categoria) && $categoria->id === $cat->id ? 'filtro-activo' : '' }}">
                            {{ $cat->nombre }}
                        </a>
                    @endforeach
                </div>
            </div>

            {{-- PRODUCTOS --}}
            <div class="col-md-9">
                <h2 class="titulo-japones">
                    {{ isset($categoria) ? $categoria->nombre : 'Nuestro Menú' }}
                </h2>

                <div class="row g-4">
                    @forelse ($productos as $producto)
                        <div class="col-sm-6 col-lg-4">
                            <div class="card h-100 shadow-sm border-0 card-producto">
                                <img src="{{ $producto->imagen ? asset('storage/' . $producto->imagen) : 'https://via.placeholder.com/600x400' }}"
                                    class="card-img-top" alt="{{ $producto->nombre }}">
                                <div class="card-body d-flex flex-column">
                                    <h5 class="card-title text-dark fw-bold">{{ $producto->nombre }}</h5>
                                    <p class="card-text text-muted mb-1">{{ Str::limit($producto->descripcion, 70) }}</p>
                                    <div class="mt-auto">
                                        <p class="fw-bold text-danger h5">
                                            ${{ number_format($producto->precio, 0, ',', '.') }}</p>
                                        {{-- <a href="{{ route('producto.detalle', $producto->id) }}" class="btn btn-danger w-100 mt-2">Ver detalle</a> --}}
                                        <button class="btn btn-danger w-100 mt-2" data-bs-toggle="modal"
                                            data-bs-target="#productoModal" data-id="{{ $producto->id }}">
                                            Ver detalle
                                        </button>

                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-12">
                            <div class="alert alert-info text-center">
                                No se encontraron productos para esta categoría.
                            </div>
                        </div>
                    @endforelse
                </div>

                {{-- PAGINACIÓN --}}
                <div class="mt-4">
                    {{ $productos->links('vendor.pagination.bootstrap-5') }}
                </div>
            </div>
        </div>
    </div>
    <!-- Modal Detalle Producto -->
    <div class="modal fade" id="productoModal" tabindex="-1" aria-labelledby="productoModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title" id="productoModalLabel">Cargando...</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                        aria-label="Cerrar"></button>
                </div>
                <div class="modal-body">
                    <div id="productoModalContenido" class="text-center text-muted">
                        <div class="spinner-border text-danger" role="status"></div>
                        <p class="mt-2">Cargando detalle del producto...</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const ingredientesInput = document.getElementById('ingredientesInput');
            const lista = document.getElementById('lista-ingredientes');
            const precioBase = parseInt(document.getElementById('precioBaseInput').value);
            const precioDisplay = document.getElementById('precio-final');
            const precioFinalInput = document.getElementById('precioFinalInput');
    
            const seleccionados = {}; // id => cantidad
    
            lista.querySelectorAll('.chip-ingrediente').forEach(chip => {
                chip.addEventListener('click', function () {
                    const id = chip.dataset.id;
                    const precio = parseInt(chip.dataset.precio);
                    const repite = chip.dataset.repite === '1';
    
                    // control de conteo
                    if (!seleccionados[id]) seleccionados[id] = 0;
    
                    // regla: si no se repite y ya fue seleccionado, no se puede agregar más
                    if (!repite && seleccionados[id] >= 1) return;
    
                    seleccionados[id] += 1;
    
                    chip.classList.add('seleccionado');
                    const counter = chip.querySelector('.counter');
                    counter.textContent = 'x' + seleccionados[id];
                    counter.classList.remove('d-none');
    
                    // calcular total
                    let adicional = 0;
                    Object.keys(seleccionados).forEach(key => {
                        const chipEl = lista.querySelector(`[data-id='${key}']`);
                        const precioChip = parseInt(chipEl.dataset.precio);
                        const cantidad = seleccionados[key];
                        const repiteChip = chipEl.dataset.repite === '1';
    
                        if (!repiteChip) {
                            adicional += precioChip;
                        } else if (cantidad <= 2) {
                            adicional += precioChip * cantidad;
                        } else {
                            adicional += (precioChip * 2) + ((cantidad - 2) * 1000);
                        }
                    });
    
                    const total = precioBase + adicional;
                    precioDisplay.textContent = '$' + total.toLocaleString('es-CL');
                    precioFinalInput.value = total;
    
                    // guardar lista en hidden input
                    ingredientesInput.value = JSON.stringify(seleccionados);
                });
            });
        });
    </script>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const modal = document.getElementById('productoModal');
                const contenido = document.getElementById('productoModalContenido');
                const titulo = document.getElementById('productoModalLabel');

                modal.addEventListener('show.bs.modal', function(event) {
                    const button = event.relatedTarget;
                    const productoId = button.getAttribute('data-id');

                    // Limpia contenido y muestra loader
                    titulo.textContent = 'Cargando...';
                    contenido.innerHTML = `
                <div class="text-center text-muted">
                    <div class="spinner-border text-danger" role="status"></div>
                    <p class="mt-2">Cargando detalle del producto...</p>
                </div>
            `;

                    fetch(`/producto/modal/${productoId}`)
                        .then(res => res.text())
                        .then(html => {
                            contenido.innerHTML = html;
                            titulo.textContent = document.getElementById('modal-producto-titulo')
                                ?.textContent || 'Detalle del producto';
                        })
                        .catch(() => {
                            contenido.innerHTML =
                                `<p class="text-danger">Hubo un error al cargar el producto.</p>`;
                            titulo.textContent = 'Error';
                        });
                });
            });
        </script>
    @endpush

@endsection
