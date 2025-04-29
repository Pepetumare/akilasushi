@extends('layouts.app')

@section('title', 'Personalizar Pedido')

@section('content')
    <div class="container py-5">
        <h1 class="text-danger fw-bold mb-4 text-center">{{ $producto->nombre }}</h1>

        <form action="{{ route('producto.agregar', $producto->id) }}" method="POST">
            @csrf

            @if ($esCombo3)
                <div class="row">
                    @for ($i = 0; $i < 3; $i++)
                        <div class="col-md-4 mb-4">
                            <div class="card shadow-sm h-100">
                                <div class="card-body">
                                    <h5 class="card-title text-primary fw-bold text-center">Hand Roll {{ $i + 1 }}
                                    </h5>

                                    <div class="mb-2">
                                        <label class="form-label">Base</label>
                                        <select name="combo[{{ $i }}][base]" class="form-select" required>
                                            @foreach ($ingredientes['bases'] as $base)
                                                <option value="{{ $base->nombre }}">{{ $base->nombre }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="mb-2">
                                        <label class="form-label">Proteína</label>
                                        <select name="combo[{{ $i }}][proteina]" class="form-select" required>
                                            @foreach ($ingredientes['proteinas'] as $p)
                                                <option value="{{ $p->nombre }}">{{ $p->nombre }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="mb-2">
                                        <label class="form-label">Vegetal</label>
                                        <select name="combo[{{ $i }}][vegetal]" class="form-select" required>
                                            @foreach ($ingredientes['vegetales'] as $v)
                                                <option value="{{ $v->nombre }}">{{ $v->nombre }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="mb-2">
                                        <label class="form-label">Envoltura</label>
                                        <select name="combo[{{ $i }}][envoltura]" class="form-select" required>
                                            @foreach ($ingredientes['envolturas'] as $e)
                                                <option value="{{ $e->nombre }}">{{ $e->nombre }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endfor
                </div>
            @else
                <p class="text-muted">Este producto no admite personalización por ahora.</p>
            @endif

            <div class="text-center mt-4">
                <button type="submit" class="btn btn-success btn-lg">Agregar al Carrito</button>
            </div>
        </form>
    </div>
@endsection
