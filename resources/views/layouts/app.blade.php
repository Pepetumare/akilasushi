<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Sushi Akila')</title>
    <link rel="shortcut icon" href="{{ asset('img/logo/logo-favicon.png') }}" type="image/png">

    <!-- Bootstrap Icons y Animate -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <link href="https://fonts.googleapis.com/css2?family=Noto+Serif+JP:wght@500;700&display=swap" rel="stylesheet">


    <!-- Vite (Bootstrap + Estilos personalizados) -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body {
            padding-top: 80px;
        }

        footer {
            background-color: #222;
            color: #fff;
            padding: 30px 0;
            text-align: center;
        }

        footer a {
            color: #ffcc00;
            text-decoration: none;
        }

        footer a:hover {
            text-decoration: underline;
        }

        .navbar-collapse {
            justify-content: flex-end;
        }

        .carousel-inner {
            height: 400px;
        }

        .carousel-item img {
            height: 100%;
            width: 100%;
            object-fit: cover;
        }
    </style>
</head>

<body class="bg-light">

    {{-- Navbar --}}
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top shadow-sm">
        <div class="container">
            <a class="navbar-brand fw-bold" href="{{ route('home') }}">
                <img src="{{ asset('img/logo/logo-light-transparent.png') }}" alt="Sushi Akila Logo" height="50">
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto text-center">
                    <li class="nav-item"><a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}"
                            href="{{ route('home') }}">Inicio</a></li>
                    <li class="nav-item"><a class="nav-link {{ request()->routeIs('menu') ? 'active' : '' }}"
                            href="{{ route('menu') }}">Menú</a></li>
                    <li class="nav-item"><a class="nav-link {{ request()->routeIs('arma') ? 'active' : '' }}"
                            href="{{ route('arma') }}">Arma tu Sushi</a></li>
                    <li class="nav-item"><a class="nav-link {{ request()->routeIs('locales') ? 'active' : '' }}"
                            href="{{ route('locales') }}">Locales</a></li>
                    <li class="nav-item"><a class="nav-link {{ request()->routeIs('contacto') ? 'active' : '' }}"
                            href="{{ route('contacto') }}">Contacto</a></li>

                    @auth
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle text-success fw-bold" href="#" id="navbarUserDropdown"
                                role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                {{ Auth::user()->name }}
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end animate__animated animate__fadeIn"
                                aria-labelledby="navbarUserDropdown">
                                @if (Auth::user()->role === 'admin')
                                    <li><a class="dropdown-item" href="{{ route('admin.dashboard') }}">Panel Admin</a></li>
                                @elseif(Auth::user()->role === 'vendedor')
                                    <li><a class="dropdown-item" href="{{ route('vendedor.dashboard') }}">Panel
                                            Vendedor</a></li>
                                @else
                                    <li><a class="dropdown-item" href="{{ route('user.perfil') }}">Mi Perfil</a></li>
                                @endif
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li>
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button type="submit" class="dropdown-item text-danger">Cerrar sesión</button>
                                    </form>
                                </li>
                            </ul>
                        </li>
                    @else
                        <li class="nav-item"><a class="nav-link" href="{{ route('login') }}">Iniciar Sesión</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('register') }}">Registrarse</a></li>
                    @endauth

                    <li class="nav-item">
                        <a href="{{ route('cart.index') }}" class="btn btn-danger ms-2">
                            <i class="bi bi-cart-fill"></i> Carrito
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    {{-- Contenido principal --}}
    <main>
        @yield('content')
    </main>

    {{-- Footer --}}
    <footer class="mt-5">
        <div class="container">
            <p class="mb-0">&copy; {{ date('Y') }} Sushi Akila. Todos los derechos reservados.</p>
            <p class="small">Desarrollado con 🍣 por José Cornejo.</p>
        </div>
    </footer>

    {{-- Botón flotante carrito --}}
    <a href="{{ route('cart.index') }}" class="btn btn-danger rounded-circle position-fixed"
        style="bottom: 30px; right: 30px; width: 60px; height: 60px; display: flex; justify-content: center; align-items: center; z-index:999;">
        <i class="bi bi-cart-fill" style="font-size: 1.5rem;"></i>
    </a>

    {{-- Toast para notificaciones --}}
    @if (session('success'))
        <div class="toast-container position-fixed bottom-0 end-0 p-3" style="z-index: 1100;">
            <div id="successToast" class="toast align-items-center text-white bg-success border-0 show" role="alert">
                <div class="d-flex">
                    <div class="toast-body">
                        {{ session('success') }}
                    </div>
                    <button type="button" class="btn-close btn-close-white me-2 m-auto"
                        data-bs-dismiss="toast"></button>
                </div>
            </div>
        </div>
        <script>
            const toastLiveExample = document.getElementById('successToast')
            if (toastLiveExample) {
                new bootstrap.Toast(toastLiveExample).show();
            }
        </script>
    @endif

    {{-- Scripts adicionales --}}
    @stack('scripts')

    

</body>

</html>
