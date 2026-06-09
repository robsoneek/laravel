@extends('layouts.app')

@section('content')
    <a href="{{ route('admin.index') }}" class="btn btn-outline-secondary mb-4">← Back to admin</a>

    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card bg-secondary text-white">
                <div class="card-body">
                    <h5 class="card-title">Add Product</h5>
                    <form method="POST" action="{{ route('admin.products.store') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" name="name" class="form-control form-control-sm" value="{{ old('name') }}">
                        </div>
                        <div class="form-group">
                            <label>Price</label>
                            <input type="number" step="0.01" name="price" class="form-control form-control-sm" value="{{ old('price') }}">
                        </div>
                        <div class="form-group">
                            <label>Quantity</label>
                            <input type="number" name="quantity" class="form-control form-control-sm" value="{{ old('quantity') }}">
                        </div>
                        <div class="form-group">
                            <label>Category</label>
                            <select name="category_id" class="form-control form-control-sm">
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Description</label>
                            <textarea name="description" class="form-control form-control-sm" rows="3">{{ old('description') }}</textarea>
                        </div>
                        <div class="form-group">
                            <label>Image</label>
                            <input type="file" name="image" class="form-control-file">
                        </div>
                        <button type="submit" class="btn btn-light btn-block">Add Product</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
