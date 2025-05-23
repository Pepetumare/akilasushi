
<div id="modal-producto-titulo" class="d-none">{{ $producto->nombre }}</div>

<style>
    .chip-ingrediente {
        display: inline-flex;
        align-items: center;
        justify-content: space-between;
        padding: 0.5rem 1rem;
        margin: 4px;
        border-radius: 25px;
        border: 2px solid #dc3545;
        background-color: #fff;
        color: #dc3545;
        font-weight: bold;
        cursor: pointer;
        transition: 0.2s ease-in-out;
        position: relative;
    }

    .chip-ingrediente:hover {
        background-color: #dc3545;
        color: white;
    }

    .chip-ingrediente.seleccionado {
        background-color: #dc3545;
        color: white;
    }

    .chip-ingrediente span.counter {
        background-color: #fff;
        color: #dc3545;
        font-size: 0.8rem;
        font-weight: bold;
        border-radius: 50%;
        padding: 2px 6px;
        position: absolute;
        top: -8px;
        right: -8px;
        border: 1px solid #dc3545;
    }

    .btn-reset {
        margin-top: 10px;
    }
</style>

<div class="row">
    <div class="col-md-6 text-center">
        <img src="{{ $producto->imagen ? asset('storage/' . $producto->imagen) : 'https://via.placeholder.com/500x300' }}"
             class="img-fluid rounded" alt="{{ $producto->nombre }}">
    </div>
    <div class="col-md-6">
        <h5 class="fw-bold text-danger">{{ $producto->nombre }}</h5>
        <p>{{ $producto->descripcion }}</p>
        <p class="h4 text-success fw-bold" id="precio-final">${{ number_format($producto->precio, 0, ',', '.') }}</p>

        @if ($producto->personalizable)
        <form method="POST" action="{{ route('producto.agregar', $producto->id) }}">
            @csrf

            {{-- Quitar Queso Crema y Cebollín --}}
            <div class="mb-3">
                <label class="form-label fw-bold">Opciones</label><br>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" name="sin_queso_crema" id="sinQuesoCrema">
                    <label class="form-check-label" for="sinQuesoCrema">Sin Queso Crema</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" name="sin_cebollin" id="sinCebollin">
                    <label class="form-check-label" for="sinCebollin">Sin Cebollín</label>
                </div>
            </div>

            {{-- INGREDIENTES CLICKEABLES --}}
            <div class="mb-3">
                <label class="form-label fw-bold">Ingredientes</label>
                <div id="lista-ingredientes">
                    @foreach ($ingredientes as $ing)
                        <div class="chip-ingrediente" data-id="{{ $ing->id }}"
                             data-nombre="{{ $ing->nombre }}"
                             data-precio="{{ $ing->precio_base }}"
                             data-repite="{{ $ing->se_repite ? '1' : '0' }}">
                            {{ $ing->nombre }}
                            <span class="counter d-none">x1</span>
                        </div>
                    @endforeach
                </div>
                <button type="button" class="btn btn-outline-secondary btn-sm btn-reset" id="resetIngredientes">Quitar Todo</button>
            </div>

            <input type="hidden" name="ingredientes" id="ingredientesInput">
            <input type="hidden" name="precio_base" id="precioBaseInput" value="{{ $producto->precio }}">
            <input type="hidden" name="precio_final" id="precioFinalInput" value="{{ $producto->precio }}">

            <button type="submit" class="btn btn-danger w-100">
                <i class="bi bi-cart-plus"></i> Agregar al carrito
            </button>
        </form>
        @endif
    </div>
</div>
