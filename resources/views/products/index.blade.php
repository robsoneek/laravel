@extends('layouts.app')

@section('content')
    <h1>All Products</h1>
    <hr>
    <div class="row">
        @foreach($products as $product)
            <div class="col-md-4 mb-4">
                <div class="card h-100">
                    @if($product->image)
                        <img src="{{ asset('storage/' . $product->image) }}" class="card-img-top" style="height:200px;object-fit:cover;">
                    @endif
                    <div class="card-body">
                        <h5 class="card-title">{{ $product->name }}</h5>
                        <p class="card-text text-muted">{{ $product->description }}</p>
                        <p class="card-text"><strong>{{ number_format($product->price, 2) }} Kč</strong></p>
                        <p class="card-text"><small>In stock: {{ $product->quantity }}</small></p>
                    </div>
                    <div class="card-footer">
                        <a href="{{ route('products.show', $product->id) }}" class="btn btn-primary btn-sm">View detail</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection
