@extends('layouts.shop')

@section('content')
    <h1 class="text-3xl font-bold mb-6">
        {{ isset($currentCategory) ? 'Category: ' . $currentCategory->name : 'All products' }}
    </h1>

    <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-6">
        @foreach($products as $product)
            <div class="bg-white rounded-lg shadow p-4 flex flex-col justify-between">
                <div>
                    <h2 class="text-xl font-bold mb-2">{{ $product->name }}</h2>
                    <p class="text-gray-600 text-sm mb-4">{{ $product->description ?? 'No description' }}</p>
                </div>

                <div class="flex justify-between items-center mt-4">
                    <span class="text-lg font-bold text-blue-600">{{ number_format($product->price, 2, ',', ' ') }} Kč</span>

                    <form action="{{ route('cart.add', $product->product_id) }}" method="POST">
                        @csrf
                        <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded">
                            Add to cart
                        </button>
                    </form>
                </div>
            </div>
        @endforeach
    </div>
@endsection
