@extends('layouts.main')

@section('title', 'Všechny produkty')

@section('content')
<h1 class="mb-4">Všechny produkty</h1>

@if($products->isEmpty())
    <p class="text-muted">Žádné produkty nenalezeny.</p>
@else
    <div class="row row-cols-1 row-cols-md-3 g-4">
        @foreach($products as $product)
            <div class="col">
                <div class="card h-100">
                    @if($product->image)
                        <img src="{{ asset('storage/' . $product->image) }}" class="card-img-top" alt="{{ $product->name }}" style="height:200px;object-fit:cover">
                    @else
                        <div class="bg-light d-flex align-items-center justify-content-center" style="height:200px">
                            <span class="text-muted">Bez obrázku</span>
                        </div>
                    @endif
                    <div class="card-body">
                        <h5 class="card-title">
                            <a href="{{ route('product.show', $product->id) }}" class="text-decoration-none">{{ $product->name }}</a>
                        </h5>
                        <span class="badge bg-secondary mb-2">{{ $product->category->name ?? 'Bez kategorie' }}</span>
                        <p class="card-text fw-bold">{{ number_format($product->price, 2, ',', ' ') }} Kč</p>
                        <p class="card-text text-muted small">Skladem: {{ $product->quantity }} ks</p>
                    </div>
                    <div class="card-footer d-flex gap-2">
                        <a href="{{ route('product.show', $product->id) }}" class="btn btn-outline-primary btn-sm">Detail</a>
                        @if($product->quantity > 0)
                            <form method="POST" action="{{ route('cart.add', $product->id) }}">
                                @csrf
                                <button class="btn btn-success btn-sm">+ Košík</button>
                            </form>
                        @else
                            <span class="btn btn-secondary btn-sm disabled">Vyprodáno</span>
                        @endif
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endif
@endsection
