@extends('layouts.main')

@section('title', $product->name)

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <a href="{{ route('category.show', $product->category_id) }}" class="btn btn-outline-secondary btn-sm mb-3">&larr; Zpět na kategorii</a>

        <div class="card">
            @if($product->image)
                <img src="{{ asset('storage/' . $product->image) }}" class="card-img-top" alt="{{ $product->name }}" style="max-height:350px;object-fit:cover">
            @endif
            <div class="card-body">
                <h2 class="card-title">{{ $product->name }}</h2>
                <span class="badge bg-secondary mb-3">{{ $product->category->name ?? 'Bez kategorie' }}</span>

                <p class="fs-4 fw-bold">{{ number_format($product->price, 2, ',', ' ') }} Kč</p>

                @if($product->description)
                    <p class="card-text">{{ $product->description }}</p>
                @endif

                @if($product->quantity > 5)
                    <span class="badge bg-success mb-3">Skladem: {{ $product->quantity }} ks</span>
                @elseif($product->quantity > 0)
                    <span class="badge bg-warning text-dark mb-3">Nízký stav: {{ $product->quantity }} ks</span>
                @else
                    <span class="badge bg-danger mb-3">Vyprodáno</span>
                @endif

                @if($product->quantity > 0)
                    <div>
                        <form method="POST" action="{{ route('cart.add', $product->id) }}">
                            @csrf
                            <button class="btn btn-success">Přidat do košíku</button>
                        </form>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
