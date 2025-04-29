@extends('layouts.app')

@section('title', 'Iniciar Sesión')

@section('content')
<div class="container py-5 d-flex justify-content-center align-items-center" style="min-height: 80vh;">
    <div class="card shadow-lg p-4" style="width: 100%; max-width: 450px;">
        <div class="text-center mb-4">
            <img src="{{ asset('img/logo/logo-dark-transparent.png') }}" alt="Sushi Akila Logo" style="height: 70px;">
        </div>

        <h3 class="text-center fw-bold mb-4 text-danger">Iniciar Sesión</h3>

        @if(session('status'))
            <div class="alert alert-success text-center">{{ session('status') }}</div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <!-- Email -->
            <div class="mb-3">
                <label class="form-label">Correo Electrónico</label>
                <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" required autofocus>
                @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Contraseña -->
            <div class="mb-4">
                <label class="form-label">Contraseña</label>
                <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" required>
                @error('password')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Botón de Login -->
            <div class="d-grid">
                <button type="submit" class="btn btn-danger btn-lg">Iniciar Sesión</button>
            </div>
        </form>

        <div class="text-center mt-3">
            <small>¿No tienes cuenta? <a href="{{ route('register') }}" class="text-danger">Regístrate</a></small>
        </div>
    </div>
</div>
@endsection
