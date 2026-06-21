@extends('layouts.app')

@section('content')
    <section class="container">
        <div class="section-title">
            <h1>Your Cart</h1>
            <a class="btn secondary" href="{{ route('store.products') }}">Continue shopping</a>
        </div>

        @if($cart['items']->isEmpty())
            <p class="muted">Your cart is empty.</p>
        @else
            <table>
                <thead>
                    <tr>
                        <th>Product</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Total</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($cart['items'] as $item)
                        <tr>
                            <td>{{ $item['name'] }}</td>
                            <td>${{ number_format($item['price'], 2) }}</td>
                            <td>
                                <form method="POST" action="{{ route('cart.update', $item['product_id']) }}">
                                    @csrf
                                    @method('PATCH')
                                    <input type="number" name="quantity" value="{{ $item['quantity'] }}" min="1">
                                    <button class="btn secondary" type="submit">Update</button>
                                </form>
                            </td>
                            <td>${{ number_format($item['line_total'], 2) }}</td>
                            <td>
                                <form method="POST" action="{{ route('cart.destroy', $item['product_id']) }}">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn danger" type="submit">Remove</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <p>Subtotal: <strong>${{ number_format($cart['subtotal'], 2) }}</strong></p>
            <p>Shipping: <strong>${{ number_format($cart['shipping'], 2) }}</strong></p>
            <p class="price">Total: ${{ number_format($cart['total'], 2) }}</p>
            <a class="btn" href="{{ route('checkout.create') }}">Checkout</a>
        @endif
    </section>
@endsection
