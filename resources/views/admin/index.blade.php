@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Admin Panel</h2>
        <div>
            <a href="{{ route('admin.products.create') }}" class="btn btn-success btn-sm mr-2">Add Product</a>
            <a href="{{ route('admin.categories.create') }}" class="btn btn-info btn-sm">Add Category</a>
        </div>
    </div>

    <table class="table table-dark table-hover table-sm">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Category</th>
                <th>Price</th>
                <th>Qty</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($products as $product)
                <tr>
                    <td>{{ $product->id }}</td>
                    <td>{{ $product->name }}</td>
                    <td>{{ $product->category->name }}</td>
                    <td>{{ number_format($product->price, 2) }} Kč</td>
                    <td>{{ $product->quantity }}</td>
                    <td class="d-flex">
                        <a href="{{ route('admin.products.edit', $product->id) }}" class="btn btn-info btn-sm mr-1">Edit</a>
                        <form method="POST" action="{{ route('admin.products.destroy', $product->id) }}">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
