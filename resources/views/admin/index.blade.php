@extends('layouts.main')

@section('title', 'Admin — přehled produktů')

@section('content')
<div class="row">
    <div class="col-md-9">
        <h2 class="mb-3">Správa produktů</h2>
        <table class="table table-dark table-striped table-hover">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Název</th>
                    <th>Kategorie</th>
                    <th>Cena (Kč)</th>
                    <th>Množství</th>
                    <th>Akce</th>
                </tr>
            </thead>
            <tbody>
                @foreach($products as $product)
                    <tr>
                        <td>{{ $product->id }}</td>
                        <td>{{ $product->name }}</td>
                        <td>{{ $product->category->name ?? '—' }}</td>
                        <td>{{ number_format($product->price, 2, ',', ' ') }}</td>
                        <td>{{ $product->quantity }}</td>
                        <td class="d-flex gap-1">
                            <form method="POST" action="{{ route('admin.products.decrease', $product->id) }}">
                                @csrf
                                <button class="btn btn-warning btn-sm" title="Odebrat 1 kus">-1</button>
                            </form>
                            <a href="{{ route('admin.products.edit', $product->id) }}" class="btn btn-info btn-sm">Upravit</a>
                            <form method="POST" action="{{ route('admin.products.destroy', $product->id) }}"
                                  onsubmit="return confirm('Opravdu smazat produkt?')">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger btn-sm">Smazat</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="col-md-3">
        <div class="card">
            <div class="card-header bg-secondary text-white">Správa</div>
            <div class="card-body d-grid gap-2">
                <a href="{{ route('admin.products.create') }}" class="btn btn-success">+ Přidat produkt</a>
                <a href="{{ route('admin.categories.create') }}" class="btn btn-outline-primary">+ Přidat kategorii</a>
                <a href="{{ route('admin.categories.index') }}" class="btn btn-outline-secondary">Správa kategorií</a>
                <a href="{{ route('admin.users.create') }}" class="btn btn-outline-secondary">+ Přidat uživatele</a>
                <a href="{{ route('admin.users.index') }}" class="btn btn-outline-secondary mr-2">Správa uživatelů</a>

</div>
            </div>
        </div>
    </div>
</div>
@endsection
