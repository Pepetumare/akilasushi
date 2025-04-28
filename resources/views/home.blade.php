@extends('layouts.app')

@section('content')
<!-- Banner Principal -->
<div class="bg-dark text-white text-center py-5" style="background: url('{{ asset('images/banner-sushi.jpg') }}') center/cover no-repeat;">
    <div class="container py-5" style="background-color: rgba(0, 0, 0, 0.5); border-radius: 15px;">
        <h1 class="display-4 fw-bold">¡Bienvenido a Sushi Akila!</h1>
        <p class="lead">La mejor experiencia de sushi en Mariquina 🍣</p>
        <div class="mt-4">
            <a href="{{ route('menu') }}" class="btn btn-danger btn-lg mx-2">Ver Menú</a>
            <a href="{{ route('arma') }}" class="btn btn-outline-light btn-lg mx-2">Arma tu Sushi</a>
        </div>
    </div>
</div>

<!-- Contenido adicional debajo -->
<div class="container py-5">
    <div class="text-center mb-5">
        <h2 class="fw-bold text-danger">¿Por qué elegirnos?</h2>
        <p class="lead">Frescura, sabor y pasión en cada rollo de sushi que servimos.</p>
    </div>
</div>
@endsection
