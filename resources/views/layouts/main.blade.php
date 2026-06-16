<!DOCTYPE html>
<html lang="cs">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Katalog produktů')</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4">
    <div class="container">
        <a class="navbar-brand" href="{{ route('home') }}">Katalog produktů</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarMain">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarMain">
            <ul class="navbar-nav me-auto">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">Kategorie</a>
                    <ul class="dropdown-menu">
                        @foreach($categories as $cat)
                            <li>
                                <a class="dropdown-item" href="{{ route('category.show', $cat->id) }}">{{ $cat->name }}</a>
                                @if($cat->children_tree->count())
                                    @foreach($cat->children_tree as $sub)
                                        <a class="dropdown-item ps-4" href="{{ route('category.show', $sub->id) }}">&mdash; {{ $sub->name }}</a>
                                        @if($sub->children_tree->count())
                                            @foreach($sub->children_tree as $subsub)
                                                <a class="dropdown-item ps-5" href="{{ route('category.show', $subsub->id) }}">&mdash;&mdash; {{ $subsub->name }}</a>
                                            @endforeach
                                        @endif
                                    @endforeach
                                @endif
                            </li>
                        @endforeach
                    </ul>
                </li>
            </ul>
            <div class="d-flex gap-2 align-items-center">
                @php $cartCount = array_sum(array_column(session('cart', []), 'quantity')); @endphp
                <a href="{{ route('cart.index') }}" class="btn btn-outline-light btn-sm position-relative">
                    Košík
                    @if($cartCount > 0)
                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">{{ $cartCount }}</span>
                    @endif
                </a>
                @auth
                    @if(auth()->user()->is_admin)
                        <a href="{{ route('admin.index') }}" class="btn btn-outline-warning btn-sm">Admin</a>
                    @endif
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="btn btn-outline-light btn-sm">Odhlásit</button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="btn btn-outline-light btn-sm">Přihlásit</a>
                @endauth
            </div>
        </div>
    </div>
</nav>

<div class="container">
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul>
        </div>
    @endif

    @yield('content')
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
