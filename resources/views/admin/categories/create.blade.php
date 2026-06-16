@extends('layouts.main')

@section('title', 'Přidat kategorii')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-6">
        <h2 class="mb-4">Přidat kategorii</h2>
        <form method="POST" action="{{ route('admin.categories.store') }}">
            @csrf
            <div class="mb-3">
                <label class="form-label">Název</label>
                <input type="text" name="name" class="form-control" value="{{ old('name') }}" required maxlength="45">
            </div>
            <div class="mb-3">
                <label class="form-label">Nadřazená kategorie (volitelné)</label>
                <select name="parent_id" class="form-select">
                    <option value="">— Žádná (kořenová kategorie) —</option>
                    @foreach($categories as $cat)
                        <option value="{{ $cat->id }}" {{ old('parent_id') == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-success">Uložit</button>
                <a href="{{ route('admin.index') }}" class="btn btn-secondary">Zrušit</a>
            </div>
        </form>

        @if($categories->count())
            <hr>
            <h5>Existující kategorie</h5>
            <ul class="list-group">
                @foreach($categories as $cat)
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        {{ $cat->name }}
                        @if($cat->parent_id)
                            <small class="text-muted">podkategorie</small>
                        @endif
                        <form method="POST" action="{{ route('admin.categories.destroy', $cat->id) }}"
                              onsubmit="return confirm('Smazat kategorii {{ $cat->name }}?')">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm">Smazat</button>
                        </form>
                    </li>
                @endforeach
            </ul>
        @endif
    </div>
</div>
@endsection
