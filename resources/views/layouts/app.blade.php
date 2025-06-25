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
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

    <style>
        .sidebar {
            min-height: 100vh;
            border-right: 1px solid #dee2e6;
            background-color: #f8f9fa;
        }

        .sidebar .nav-link.active {
            font-weight: bold;
            background-color: #e9ecef;
        }
    </style>
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container-fluid">
                <!-- Sidebar toggle for small devices -->
                <button class="btn btn-outline-secondary d-md-none me-2" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu">
                    ☰
                </button>

                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>

                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ms-auto">
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown" role="button">
                                    {{ Auth::user()->name }}
                                </a>
                                <div class="dropdown-menu dropdown-menu-end">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
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

        <div class="container-fluid">
            <div class="row">
                <!-- Sidebar -->
                <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block sidebar collapse show">
                    <div class="pt-3">
                        <ul class="nav flex-column">
                            <li class="nav-item">
                                <a class="nav-link {{ request()->is('home') ? 'active' : '' }}" href="{{ url('/home') }}">
                                    Dashboard
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ request()->is('products*') ? 'active' : '' }}" href="{{ route('products.index') }}">
                                    Products
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ request()->is('sales*') ? 'active' : '' }}" href="{{ route('sales.index') }}">
                                    Sales
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ request()->is('reports*') ? 'active' : '' }}" href="{{ route('reports.index') }}">
                                    Reports
                                </a>
                            </li>
                        </ul>
                    </div>
                </nav>

             
                <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 py-4">
                    @yield('content')
                </main>
            </div>
        </div>
    </div>
</body>
</html>
