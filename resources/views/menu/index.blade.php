@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="text-center mb-5">
        <h1 class="fw-bold text-danger">Nuestro Menú</h1>
        <p class="lead">Explora nuestras delicias japonesas.</p>
    </div>

    <div class="row">
        @foreach($productos as $producto)
        <div class="col-md-4 mb-4">
            <div class="card h-100 shadow-sm">
                <img src="{{ asset('storage/' . $producto->imagen) }}" class="card-img-top" alt="{{ $producto->nombre }}">
                <div class="card-body text-center">
                    <h5 class="card-title">{{ $producto->nombre }}</h5>
                    <p class="card-text">${{ number_format($producto->precio, 0, ',', '.') }} CLP</p>
                    <a href="{{ route('producto.show', $producto->id) }}" class="btn btn-danger">Ver Detalle</a>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection
