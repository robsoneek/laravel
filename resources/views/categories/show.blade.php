@extends('layouts.main')

@section('title', $category->name)

@section('content')
<h1 class="mb-3">{{ $category->name }}</h1>

<div class="mb-4 d-flex gap-2 align-items-center flex-wrap">
    <span class="text-muted">Seřadit podle:</span>
    @foreach(['name' => 'Název', 'price' => 'Cena', 'quantity' => 'Množství'] as $col => $label)
        @php
            $dir = ($sortColumn === $col && $sortDir === 'asc') ? 'desc' : 'asc';
            $icon = $sortColumn === $col ? ($sortDir === 'asc' ? ' ▲' : ' ▼') : '';
        @endphp
        <a href="{{ route('category.show', $category->id) }}?sort={{ $col }}&dir={{ $dir }}"
           class="btn btn-sm {{ $sortColumn === $col ? 'btn-primary' : 'btn-outline-secondary' }}">
            {{ $label }}{{ $icon }}
        </a>
    @endforeach
</div>

@if($products->isEmpty())
    <p class="text-muted">V této kategorii nejsou žádné produkty.</p>
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
