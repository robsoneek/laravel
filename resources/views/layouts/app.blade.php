<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'E-shop') }}</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" href="{{ route('home') }}">E-shop</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
            @foreach($categories as $cat)
                @if(empty($cat->children_loaded))
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('categories.show', $cat->id) }}">{{ $cat->name }}</a>
                    </li>
                @else
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown">{{ $cat->name }}</a>
                        <div class="dropdown-menu">
                            @foreach($cat->children_loaded as $child)
                                <a class="dropdown-item" href="{{ route('categories.show', $child->id) }}">{{ $child->name }}</a>
                            @endforeach
                        </div>
                    </li>
                @endif
            @endforeach
        </ul>
    </div>
    <div class="ml-auto d-flex align-items-center">
        @auth
            <a href="{{ route('cart.index') }}" class="btn btn-outline-light btn-sm mr-2">Cart</a>
            @if(auth()->user()->is_admin)
                <a href="{{ route('admin.index') }}" class="btn btn-outline-warning btn-sm mr-2">Admin</a>
            @endif
            <form method="POST" action="{{ route('logout') }}" class="d-inline">
                @csrf
                <button class="btn btn-outline-danger btn-sm">Logout</button>
            </form>
        @else
            <a href="{{ route('login') }}" class="btn btn-outline-light btn-sm mr-2">Login</a>
            <a href="{{ route('register') }}" class="btn btn-outline-light btn-sm">Register</a>
        @endauth
    </div>
</nav>

<div class="container mt-4">
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @yield('content')
</div>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>
</html>
