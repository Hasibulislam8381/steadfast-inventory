<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Welcome</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

    <nav class="navbar navbar-light bg-white shadow-sm">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}">
                {{ config('app.name', 'Laravel') }}
            </a>

            <div>
                @guest
                    <a href="{{ route('login') }}" class="btn btn-outline-primary me-2">Login</a>
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="btn btn-primary">Register</a>
                    @endif
                @else
                    <span class="me-3">Hello, {{ Auth::user()->name }}</span>
                    <form action="{{ route('logout') }}" method="POST" class="d-inline">
                        @csrf
                        <button type="submit" class="btn btn-danger btn-sm">Logout</button>
                    </form>
                @endguest
            </div>
        </div>
    </nav>

    <div class="d-flex justify-content-center align-items-center" style="height: 80vh;">
        <div class="text-center">
           <img width="100%" src="https://images.unsplash.com/photo-1506744038136-46273834b3fb?auto=format&fit=crop&w=800&q=80" alt="Ecommerce Product Display" class="img-fluid mb-4" style="max-width: 400px;">

            <h1 class="mb-3">Welcome to {{ config('app.name', 'Laravel') }}</h1>
            <p class="lead text-muted">Your simple inventory & financial reporting system.</p>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
