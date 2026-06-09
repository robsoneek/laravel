@extends('layouts.app')

@section('content')
    <a href="{{ route('categories.show', $product->category_id) }}" class="btn btn-outline-secondary mb-4">
        ← Back to {{ $product->category->name }}
    </a>

    <div class="card shadow-sm">
        <div class="card-body p-5">
            <span class="badge badge-info mb-3">{{ $product->category->name }}</span>
            <h1 class="mb-1">{{ $product->name }}</h1>
            <hr>

            @if($product->image)
                <img src="{{ asset('storage/' . $product->image) }}" class="img-fluid mb-4 rounded" style="max-height:300px;object-fit:cover;">
            @endif

            <h2 class="text-primary mb-4">{{ number_format($product->price, 2) }} Kč</h2>
            <p class="lead mb-4">{{ $product->description }}</p>

            <p class="{{ $product->quantity > 5 ? 'text-success' : 'text-danger' }} font-weight-bold">
                {{ $product->quantity > 0 ? $product->quantity . ' units available' : 'Out of stock' }}
            </p>

            @auth
                <form method="POST" action="{{ route('cart.add', $product->id) }}">
                    @csrf
                    <button class="btn btn-success">Add to cart</button>
                </form>
            @else
                <a href="{{ route('login') }}" class="btn btn-outline-success">Login to add to cart</a>
            @endauth
        </div>
    </div>
@endsection
