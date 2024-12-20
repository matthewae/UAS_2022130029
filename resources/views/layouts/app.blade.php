<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito:400,600,700|Poppins:400,600,700&display=swap" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

    <!-- Custom CSS -->
    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }
        .navbar-brand {
            margin-left: -15px; /* Adjust the logo position */
        }
        .navbar .nav-link {
            font-size: 1.1rem; /* Increase font size */
        }
        .navbar .dropdown-menu {
            font-size: 0.9rem; /* Adjust font size of dropdown */
        }
        .nav-link.active {
            background-color: #f8f9fa; /* Light background for active item */
            color: #000; /* Dark text for active item */
            border-radius: 5px; /* Rounded corners */
        }
    </style>
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-lg navbar-dark bg-primary shadow-lg">
            <div class="container">
                <!-- Brand -->
                <a class="navbar-brand d-flex align-items-center" href="{{ url('/') }}">
                    <img src="{{ asset('storage/products/Logo.jpg') }}" alt="Logo" style="width: 50px; height: 50px; margin-right: 10px;">
                    <span style="font-size: 1.5rem;">{{ config('app.name', 'Laravel') }}</span>
                </a>

                <!-- Toggler -->
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <!-- Navbar Items -->
                <div class="collapse navbar-collapse" id="navbarNav">
                    <!-- Left Side -->
                    <ul class="navbar-nav me-auto">
                        <li class="nav-item">
                            <a class="nav-link text-light {{ Request::is('products') || Request::is('/') ? 'active' : '' }}" href="{{ route('products.index') }}">
                                <i class="fas fa-th"></i> All Products
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-light {{ Request::is('products/oli-motor') ? 'active' : '' }}" href="{{ route('products.oli-motor') }}">
                                <i class="fas fa-oil-can"></i> Oli Motor
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-light {{ Request::is('products/lampu-motor') ? 'active' : '' }}" href="{{ route('products.lampu-motor') }}">
                                <i class="fas fa-lightbulb"></i> Lampu Motor
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-light {{ Request::is('products/ban') ? 'active' : '' }}" href="{{ route('products.ban') }}">
                                <i class="fas fa-tire"></i> Ban Motor
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-light {{ Request::is('products/sparepart') ? 'active' : '' }}" href="{{ route('products.sparepart') }}">
                                <i class="fas fa-tools"></i> Sparepart
                            </a>
                        </li>
                    </ul>

                    <!-- Right Side -->
                    <ul class="navbar-nav ms-auto">
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link text-light" href="{{ route('login') }}"><i class="fas fa-sign-in-alt"></i> {{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link text-light" href="{{ route('register') }}"><i class="fas fa-user-plus"></i> {{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item">
                                <a class="nav-link text-light" href="{{ route('transaction-history') }}"><i class="fas fa-history"></i> Transaction History</a>
                            </li>
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle text-light" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fas fa-user-circle"></i> {{ Auth::user()->name }}
                                </a>
                                <div class="dropdown-menu dropdown-menu-end">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                        document.getElementById('logout-form').submit();">
                                        <i class="fas fa-sign-out-alt"></i> {{ __('Logout') }}
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>
</html>
