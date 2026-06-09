<!DOCTYPE html>
<html lang="cs">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Catalog</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <nav class="bg-white shadow-md p-4 mb-6">
        <div class="container mx-auto flex justify-between items-center">
            <div class="flex space-x-6 items-center">
                <a href="{{ route('home') }}" class="text-xl font-bold text-blue-600">Catalog</a>

                @foreach($categories as $category)
                    <a href="{{ route('categories.show', $category->category_id) }}" class="text-gray-600 hover:text-black">
                        {{ $category->name }}
                    </a>
                @endforeach
            </div>

            <div class="flex space-x-4">
                <a href="{{ route('cart.index') }}" class="font-bold text-green-600">Cart ({{ count(session('cart', [])) }})</a>
                @auth
                    <a href="{{ route('admin.index') }}" class="text-gray-600">Admin</a>
                @else
                    <a href="{{ route('login') }}" class="text-gray-600">Login</a>
                @endauth
            </div>
        </div>
    </nav>

    <div class="container mx-auto px-4">
        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4">
                {{ session('success') }}
            </div>
        @endif

        @yield('content')
    </div>
</body>
</html>
