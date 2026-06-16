@extends('layouts.main')

@section('title', 'Košík')

@section('content')
<h1 class="mb-4">Košík</h1>

@if(empty($cart))
    <div class="alert alert-info">Košík je prázdný. <a href="{{ route('home') }}">Pokračovat v nákupu</a></div>
@else
    <table class="table table-bordered align-middle">
        <thead class="table-dark">
            <tr>
                <th>Obrázek</th>
                <th>Název</th>
                <th>Cena za kus</th>
                <th>Množství</th>
                <th>Celkem</th>
                <th>Akce</th>
            </tr>
        </thead>
        <tbody>
            @foreach($cart as $id => $item)
                <tr>
                    <td style="width:80px">
                        @if($item['image'])
                            <img src="{{ asset('storage/' . $item['image']) }}" alt="{{ $item['name'] }}" style="width:70px;height:70px;object-fit:cover" class="rounded">
                        @else
                            <div class="bg-light rounded d-flex align-items-center justify-content-center" style="width:70px;height:70px">
                                <span class="text-muted small">Bez foto</span>
                            </div>
                        @endif
                    </td>
                    <td>{{ $item['name'] }}</td>
                    <td>{{ number_format($item['price'], 2, ',', ' ') }} Kč</td>
                    <td>{{ $item['quantity'] }}</td>
                    <td>{{ number_format($item['price'] * $item['quantity'], 2, ',', ' ') }} Kč</td>
                    <td>
                        <form method="POST" action="{{ route('cart.remove', $id) }}">
                            @csrf
                            <button class="btn btn-danger btn-sm">Odebrat</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr class="table-dark">
                <td colspan="4" class="text-end fw-bold">Celková cena:</td>
                <td class="fw-bold">{{ number_format($total, 2, ',', ' ') }} Kč</td>
                <td></td>
            </tr>
        </tfoot>
    </table>

    <div class="d-flex gap-2 mt-3">
        <a href="{{ route('home') }}" class="btn btn-outline-secondary">Pokračovat v nákupu</a>
        <form method="POST" action="{{ route('cart.clear') }}">
            @csrf
            <button class="btn btn-success" onclick="return confirm('Dokončit objednávku a vyprázdnit košík?')">
                Dokončit objednávku
            </button>
        </form>
    </div>
@endif
@endsection
