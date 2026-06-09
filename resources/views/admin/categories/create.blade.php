@extends('layouts.app')

@section('content')
    <a href="{{ route('admin.index') }}" class="btn btn-outline-secondary mb-4">← Back to admin</a>

    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card bg-secondary text-white">
                <div class="card-body">
                    <h5 class="card-title">Add Category</h5>
                    <form method="POST" action="{{ route('admin.categories.store') }}">
                        @csrf
                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" name="name" class="form-control form-control-sm" value="{{ old('name') }}">
                        </div>
                        <div class="form-group">
                            <label>Parent Category</label>
                            <select name="parent_id" class="form-control form-control-sm">
                                <option value="">None (root category)</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <button type="submit" class="btn btn-light btn-block">Add Category</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
