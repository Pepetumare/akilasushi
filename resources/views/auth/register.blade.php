@extends('layouts.app')

@section('title', 'Registrarse')

@section('content')
<div class="container py-5 d-flex justify-content-center align-items-center" style="min-height: 80vh;">
    <div class="card shadow-lg p-4" style="width: 100%; max-width: 450px;">
        <div class="text-center mb-4">
            <img src="{{ asset('img/logo/logo-dark-transparent.png') }}" alt="Sushi Akila Logo" style="height: 70px;">
        </div>

        <h3 class="text-center fw-bold mb-4 text-danger">Crear Cuenta</h3>

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <!-- Nombre -->
            <div class="mb-3">
                <label class="form-label">Nombre Completo</label>
                <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" required autofocus>
                @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Email -->
            <div class="mb-3">
                <label class="form-label">Correo Electrónico</label>
                <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" required>
                @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Contraseña -->
            <div class="mb-3">
                <label class="form-label">Contraseña</label>
                <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" required>
                @error('password')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Confirmar contraseña -->
            <div class="mb-4">
                <label class="form-label">Confirmar Contraseña</label>
                <input type="password" name="password_confirmation" class="form-control" required>
            </div>
            <p class="text-muted">Token: {{ csrf_token() }}</p>
            <!-- Botón de registro -->
            <div class="d-grid">
                <button type="submit" class="btn btn-danger btn-lg">Registrarse</button>
            </div>
        </form>

        <div class="text-center mt-3">
            <small>¿Ya tienes cuenta? <a href="{{ route('login') }}" class="text-danger">Iniciar sesión</a></small>
        </div>
    </div>
</div>
@endsection
