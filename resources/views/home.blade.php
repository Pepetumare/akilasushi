@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="text-center mb-5">
        <h1 class="fw-bold text-danger">¡Bienvenido a Sushi Akila!</h1>
        <p class="lead">Disfruta la mejor experiencia japonesa en Mariquina.</p>
    </div>

    <div class="row">
        <div class="col-md-4 mb-4">
            <div class="card h-100 shadow-sm">
                <img src="{{ asset('images/home-menu.jpg') }}" class="card-img-top" alt="Menú">
                <div class="card-body text-center">
                    <h5 class="card-title">Ver Menú</h5>
                    <a href="{{ route('menu') }}" class="btn btn-danger">Ver Más</a>
                </div>
            </div>
        </div>

        <div class="col-md-4 mb-4">
            <div class="card h-100 shadow-sm">
                <img src="{{ asset('images/home-arma.jpg') }}" class="card-img-top" alt="Arma tu Sushi">
                <div class="card-body text-center">
                    <h5 class="card-title">Arma tu Sushi</h5>
                    <a href="{{ route('arma') }}" class="btn btn-danger">Personalizar</a>
                </div>
            </div>
        </div>

        <div class="col-md-4 mb-4">
            <div class="card h-100 shadow-sm">
                <img src="{{ asset('images/home-locales.jpg') }}" class="card-img-top" alt="Locales">
                <div class="card-body text-center">
                    <h5 class="card-title">Nuestros Locales</h5>
                    <a href="{{ route('locales') }}" class="btn btn-danger">Ver Locales</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
