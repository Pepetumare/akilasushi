<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Sushi Akila')</title>
    <link rel="shortcut icon" href="{{ asset('images/logo-favicon.png') }}" type="image/png">

    <!-- Bootstrap 5 CSS CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Bootstrap 5 JS Bundle CDN -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" defer></script>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        body {
            padding-top: 80px;
        }

        .navbar-brand img {
            height: 50px;
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

        @media (min-width: 992px) {

            /* lg breakpoint de Bootstrap */
            .navbar-collapse {
                display: flex !important;
            }
        }
    </style>
</head>

<body class="bg-light">

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top shadow-sm">
        <div class="container">
            <a class="navbar-brand fw-bold" href="{{ route('home') }}">
                <img src="{{ asset('images/logo-light-transparent.png') }}" alt="Sushi Akila Logo" height="50">
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto text-center">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}"
                            href="{{ route('home') }}">Inicio</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('menu') ? 'active' : '' }}"
                            href="{{ route('menu') }}">Menú</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('arma') ? 'active' : '' }}"
                            href="{{ route('arma') }}">Arma tu Sushi</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('locales') ? 'active' : '' }}"
                            href="{{ route('locales') }}">Locales</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('contacto') ? 'active' : '' }}"
                            href="{{ route('contacto') }}">Contacto</a>
                    </li>
                </ul>

                <a href="#" class="btn btn-danger ms-3">
                    <i class="bi bi-cart-fill"></i> Carrito
                </a>
            </div>
        </div>
    </nav>





    <!-- Main Content -->
    <main>
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="mt-5">
        <div class="container">
            <p class="mb-0">&copy; {{ date('Y') }} Sushi Akila. Todos los derechos reservados.</p>
            <p class="small">Desarrollado con 🍣 por José Cornejo.</p>
        </div>
    </footer>

    @stack('scripts')

</body>

</html>
