@extends('layouts.app')

@section('title', 'Carrito de Compras')

@section('content')
<div class="container py-5">
    <h1 class="fw-bold text-danger text-center mb-4">Carrito de Compras</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if(count($cart) > 0)
        <div class="table-responsive">
            <table class="table table-bordered align-middle text-center">
                <thead class="table-dark">
                    <tr>
                        <th>Producto</th>
                        <th>Precio</th>
                        <th>Cantidad</th>
                        <th>Subtotal</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($cart as $id => $item)
                    <tr>
                        <td>{{ $item['nombre'] }}</td>
                        <td>${{ number_format($item['precio'], 0, ',', '.') }}</td>
                        <td>{{ $item['cantidad'] }}</td>
                        <td>${{ number_format($item['precio'] * $item['cantidad'], 0, ',', '.') }}</td>
                        <td>
                            <a href="{{ route('cart.remove', $id) }}" class="btn btn-sm btn-danger">Eliminar</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <h3 class="text-end fw-bold">Total: ${{ number_format($total, 0, ',', '.') }}</h3>

        <div class="text-center mt-4">
            <a href="#" class="btn btn-success btn-lg">Finalizar Pedido</a>
        </div>

    @else
        <div class="alert alert-info text-center">
            No tienes productos en el carrito.
            <div class="mt-3">
                <a href="{{ route('menu') }}" class="btn btn-danger">Ir al Menú</a>
            </div>
        </div>
    @endif
</div>
@endsection
