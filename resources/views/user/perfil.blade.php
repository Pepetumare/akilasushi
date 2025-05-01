@extends('layouts.app')

@section('title', 'Mi Perfil')

@section('content')
<div class="container py-5">
    <h1 class="fw-bold text-danger mb-4 text-center">¡Hola {{ Auth::user()->name }}!</h1>

    <div class="card shadow">
        <div class="card-body text-center">
            <p class="lead">Bienvenido a tu panel personal.</p>
            <p>Aquí más adelante podrás ver tus pedidos, historial y actualizar tus datos.</p>

            <a href="{{ route('menu') }}" class="btn btn-outline-danger mt-3">Ir al menú</a>
        </div>
    </div>
</div>
@endsection
