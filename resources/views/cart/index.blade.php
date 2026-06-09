@extends('layouts.app')

@section('content')
    <h2>Your Cart</h2>
    <hr>

    @if(empty($cart))
        <p>Your cart is empty.</p>
        <a href="{{ route('home') }}" class="btn btn-primary">Continue shopping</a>
    @else
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>Product</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Subtotal</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach($cart as $id => $item)
                    <tr>
                        <td>{{ $item['name'] }}</td>
                        <td>{{ number_format($item['price'], 2) }} Kč</td>
                        <td>{{ $item['quantity'] }}</td>
                        <td>{{ number_format($item['price'] * $item['quantity'], 2) }} Kč</td>
                        <td>
                            <form method="POST" action="{{ route('cart.remove', $id) }}">
                                @csrf
                                <button class="btn btn-danger btn-sm">Remove</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="3"><strong>Total</strong></td>
                    <td colspan="2"><strong>{{ number_format($total, 2) }} Kč</strong></td>
                </tr>
            </tfoot>
        </table>

        <form method="POST" action="{{ route('cart.checkout') }}">
            @csrf
            <button class="btn btn-success">Place Order</button>
        </form>
    @endif
@endsection
