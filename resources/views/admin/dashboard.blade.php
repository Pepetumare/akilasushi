@extends('layouts.app')

@section('title', 'Panel de Administración')

@section('content')
<div class="container py-5">
    <h1 class="text-danger fw-bold mb-4 text-center">Panel de Administración</h1>

    <div class="row g-4 mb-5">
        <div class="col-md-4">
            <div class="card text-white bg-primary shadow h-100">
                <div class="card-body">
                    <h5 class="card-title">Total Productos</h5>
                    <p class="display-6 fw-bold">{{ $totalProductos }}</p>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card text-white bg-success shadow h-100">
                <div class="card-body">
                    <h5 class="card-title">Pedidos Hoy</h5>
                    <p class="display-6 fw-bold">{{ $pedidosHoy }}</p>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card text-white bg-dark shadow h-100">
                <div class="card-body">
                    <h5 class="card-title">Ventas Totales (CLP)</h5>
                    <p class="display-6 fw-bold">${{ number_format($ventasTotales, 0, ',', '.') }}</p>
                </div>
            </div>
        </div>
    </div>

    <h4 class="mb-3 fw-bold">Accesos Rápidos</h4>
    <div class="d-grid gap-3">
        <a href="{{ route('productos.index') }}" class="btn btn-outline-primary btn-lg">Administrar Productos</a>
        <a href="#" class="btn btn-outline-success btn-lg">Ver Pedidos</a>
        <a href="#" class="btn btn-outline-warning btn-lg">Editar Banners / Promociones</a>
    </div>
</div>
@endsection
