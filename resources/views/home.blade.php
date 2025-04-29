@extends('layouts.app')

@section('title', 'Inicio')

@section('content')

<!-- Banner Principal -->
<div class="container-fluid p-0">
    <div class="banner-home d-flex align-items-center justify-content-center text-center text-white" style="background: url('https://images.unsplash.com/photo-1603090240854-4580d56ac41e?ixlib=rb-4.0.3&auto=format&fit=crop&w=1920&q=80') no-repeat center center/cover; height: 80vh;">
        <div class="bg-dark bg-opacity-50 p-4 rounded">
            <h1 class="display-4 fw-bold">¡Bienvenido a Sushi Akila!</h1>
            <p class="lead">Siente el sabor japonés más cerca que nunca.</p>
            <a href="{{ route('menu') }}" class="btn btn-danger btn-lg mt-3">Ver Menú</a>
        </div>
    </div>
</div>

<!-- Carrusel de Promociones -->
<div class="container py-5">
    <div id="promoCarousel" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner rounded shadow">

            <div class="carousel-item active">
                <img src="img/banner1.jpg" class="d-block w-100" alt="Promo 1">
            </div>

            <div class="carousel-item">
                <img src="img/banner2.png" class="d-block w-100" alt="Promo 2">
            </div>

            <div class="carousel-item">
                <img src="img/banner3.jpg" class="d-block w-100" alt="Promo 3">
            </div>

        </div>

        <button class="carousel-control-prev" type="button" data-bs-target="#promoCarousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon"></span>
            <span class="visually-hidden">Anterior</span>
        </button>

        <button class="carousel-control-next" type="button" data-bs-target="#promoCarousel" data-bs-slide="next">
            <span class="carousel-control-next-icon"></span>
            <span class="visually-hidden">Siguiente</span>
        </button>
    </div>
</div>

<!-- Secciones rápidas -->
<div class="container pb-5">
    <div class="row text-center">

        <div class="col-md-4 mb-4">
            <div class="card shadow h-100">
                <div class="card-body">
                    <h5 class="card-title">Menú</h5>
                    <p class="card-text">Explora nuestros rolls, hand rolls, gohan y más.</p>
                    <a href="{{ route('menu') }}" class="btn btn-danger">Ver Menú</a>
                </div>
            </div>
        </div>

        <div class="col-md-4 mb-4">
            <div class="card shadow h-100">
                <div class="card-body">
                    <h5 class="card-title">Arma tu Sushi</h5>
                    <p class="card-text">Personaliza tu experiencia. ¡Elige tus ingredientes favoritos!</p>
                    <a href="{{ route('arma') }}" class="btn btn-danger">Personalizar</a>
                </div>
            </div>
        </div>

        <div class="col-md-4 mb-4">
            <div class="card shadow h-100">
                <div class="card-body">
                    <h5 class="card-title">Locales</h5>
                    <p class="card-text">Encuentra el local de Sushi Akila más cercano.</p>
                    <a href="{{ route('locales') }}" class="btn btn-danger">Ver Locales</a>
                </div>
            </div>
        </div>

    </div>
</div>

@endsection
