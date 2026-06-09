@extends('layouts.app')

@section('content')
    <a href="{{ route('admin.index') }}" class="btn btn-outline-secondary mb-4">← Back to admin</a>

    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card bg-secondary text-white">
                <div class="card-body">
                    <h5 class="card-title">Edit Product</h5>
                    <form method="POST" action="{{ route('admin.products.update', $product->id) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" name="name" class="form-control form-control-sm" value="{{ $product->name }}">
                        </div>
                        <div class="form-group">
                            <label>Price</label>
                            <input type="number" step="0.01" name="price" class="form-control form-control-sm" value="{{ $product->price }}">
                        </div>
                        <div class="form-group">
                            <label>Quantity</label>
                            <input type="number" name="quantity" class="form-control form-control-sm" value="{{ $product->quantity }}">
                        </div>
                        <div class="form-group">
                            <label>Category</label>
                            <select name="category_id" class="form-control form-control-sm">
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ $category->id === $product->category_id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Description</label>
                            <textarea name="description" class="form-control form-control-sm" rows="3">{{ $product->description }}</textarea>
                        </div>
                        <div class="form-group">
                            <label>Image</label>
                            @if($product->image)
                                <img src="{{ asset('storage/' . $product->image) }}" class="d-block mb-2 rounded" style="height:80px;object-fit:cover;">
                            @endif
                            <input type="file" name="image" class="form-control-file">
                        </div>
                        <button type="submit" class="btn btn-light btn-block">Save changes</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
