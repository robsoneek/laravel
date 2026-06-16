@extends('layouts.main')

@section('title', 'Přidat produkt')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-6">
        <h2 class="mb-4">Přidat produkt</h2>
        <form method="POST" action="{{ route('admin.products.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label class="form-label">Název</label>
                <input type="text" name="name" class="form-control" value="{{ old('name') }}" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Cena (Kč)</label>
                <input type="number" name="price" class="form-control" step="0.01" min="0" value="{{ old('price') }}" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Množství (ks)</label>
                <input type="number" name="quantity" class="form-control" min="0" value="{{ old('quantity', 0) }}" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Kategorie</label>
                <select name="category_id" class="form-select" required>
                    <option value="">— Vyberte kategorii —</option>
                    @foreach($categories as $cat)
                        <option value="{{ $cat->id }}" {{ old('category_id') == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label class="form-label">Popis</label>
                <textarea name="description" class="form-control" rows="3" maxlength="500">{{ old('description') }}</textarea>
            </div>
            <div class="mb-3">
                <label class="form-label">Obrázek</label>
                <input type="file" name="image" class="form-control" accept="image/*">
            </div>
            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-success">Uložit</button>
                <a href="{{ route('admin.index') }}" class="btn btn-secondary">Zrušit</a>
            </div>
        </form>
    </div>
</div>
@endsection
