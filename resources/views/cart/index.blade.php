@extends('layouts.app')

@section('title', 'Carrito de Compras')

@section('content')
    <div class="container py-5">
        <h1 class="fw-bold text-danger text-center mb-4">Carrito de Compras</h1>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if (count($cart) > 0)
            <div class="table-responsive">
                <table class="table table-bordered align-middle text-center">
                    <thead class="table-dark">
                        <tr>
                            <th>Producto</th>
                            <th>Ingredientes</th>
                            <th>Precio</th>
                            <th>Cantidad</th>
                            <th>Subtotal</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($cart as $id => $item)
                            <tr>
                                <td>
                                    <strong>{{ $item['nombre'] }}</strong>

                                    @if (!empty($item['ingredientes']) && is_array($item['ingredientes']))
                                        <ul class="list-unstyled small mt-2">
                                            @foreach ($item['ingredientes'] as $ingId => $cantidad)
                                                @php
                                                    $nombreIng =
                                                        \App\Models\Ingrediente::find($ingId)?->nombre ?? 'Ingrediente';
                                                @endphp
                                                <li>{{ $nombreIng }} x{{ $cantidad }}</li>
                                            @endforeach
                                        </ul>
                                    @endif
                                </td>

                                <td>
                                    @if (isset($item['ingredientes']))
                                        @php
                                            $ingredientesArray = is_array($item['ingredientes'])
                                                ? $item['ingredientes']
                                                : json_decode($item['ingredientes'], true);
                                        @endphp

                                        @if (is_array($ingredientesArray))
                                            <ul class="list-unstyled small mt-2">
                                                @foreach ($ingredientesArray as $ingId => $cantidad)
                                                    @php
                                                        $nombreIng =
                                                            \App\Models\Ingrediente::find($ingId)?->nombre ??
                                                            'Ingrediente';
                                                    @endphp
                                                    <li>{{ $nombreIng }} x{{ $cantidad }}</li>
                                                @endforeach
                                            </ul>
                                        @endif
                                    @endif

                                </td>

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
