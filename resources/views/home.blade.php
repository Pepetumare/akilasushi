@extends('layouts.app')

@section('title', 'Inicio - Sushi Akila')

@section('content')
<div class="container-fluid p-0">

    {{-- HERO PRINCIPAL --}}
    <div class="bg-dark text-white text-center py-5" style="background-image: url('https://images.unsplash.com/photo-1553621042-f6e147245754'); background-size: cover; background-position: center;">
        <div class="bg-black bg-opacity-75 py-5">
            <h1 class="display-4 fw-bold">¡Sushi con personalidad, hecho a tu manera!</h1>
            <p class="lead">Descubre los mejores rolls, gohan y combos personalizados</p>
            <a href="{{ route('menu') }}" class="btn btn-danger btn-lg mt-3">Haz tu pedido</a>
        </div>
    </div>

    {{-- SECCIÓN DE PROMOCIONES DESTACADAS --}}
    <div class="container py-5">
        <h2 class="fw-bold text-center mb-4">Promociones destacadas</h2>
        <div class="row g-4">
            @foreach($promociones ?? [] as $promo)
                <div class="col-md-4">
                    <div class="card h-100 shadow">
                        <img src="{{ $promo->imagen ? asset('storage/' . $promo->imagen) : 'https://via.placeholder.com/600x400' }}" class="card-img-top" alt="{{ $promo->nombre }}">
                        <div class="card-body text-center">
                            <h5 class="card-title">{{ $promo->nombre }}</h5>
                            <p class="card-text">${{ number_format($promo->precio, 0, ',', '.') }}</p>
                            <a href="{{ route('producto.detalle', $promo->id) }}" class="btn btn-outline-danger">Ver detalle</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    {{-- SECCIÓN DE CATEGORÍAS DESTACADAS --}}
    <div class="bg-light py-5">
        <div class="container">
            <h2 class="fw-bold text-center mb-4">Categorías</h2>
            <div class="row g-4">
                @foreach($categorias ?? [] as $categoria)
                    <div class="col-md-3">
                        <div class="card text-center shadow-sm h-100">
                            <div class="card-body">
                                <h5 class="card-title">{{ $categoria->nombre }}</h5>
                                <a href="{{ route('menu', ['categoria' => $categoria->id]) }}" class="btn btn-sm btn-danger mt-2">Ver productos</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

</div>
@endsection
