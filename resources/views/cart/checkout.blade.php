@extends('layouts.app')

@section('title', 'Finalizar Pedido')

@section('content')
<div class="container py-5">
    <h1 class="fw-bold text-danger text-center mb-4">Finalizar Pedido</h1>

    @if(count($cart) > 0)
    <form action="#" method="POST">
        @csrf
        <div class="mb-3">
            <label class="form-label">Nombre Completo</label>
            <input type="text" name="nombre" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Teléfono</label>
            <input type="text" name="telefono" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Dirección de Entrega</label>
            <textarea name="direccion" class="form-control" rows="3" required></textarea>
        </div>

        <h4 class="mt-4 fw-bold">Total: ${{ number_format($total, 0, ',', '.') }}</h4>

        <div class="text-center mt-4">
            <button type="submit" class="btn btn-success btn-lg">Confirmar Pedido</button>
        </div>
    </form>
    @else
    <div class="alert alert-info text-center">
        No tienes productos en el carrito.
    </div>
    @endif
</div>
@endsection
