@extends('layouts.app')

@section('content')
    <section class="container split">
        <div>
            <h1>Checkout</h1>
            <form class="form-grid" method="POST" action="{{ route('checkout.store') }}">
                @csrf
                <div class="field">
                    <label>Name</label>
                    <input name="customer_name" value="{{ old('customer_name') }}" required>
                </div>
                <div class="field">
                    <label>Email</label>
                    <input type="email" name="customer_email" value="{{ old('customer_email') }}" required>
                </div>
                <div class="field">
                    <label>Phone</label>
                    <input name="customer_phone" value="{{ old('customer_phone') }}" required>
                </div>
                <div class="field full">
                    <label>Shipping address</label>
                    <textarea name="shipping_address" required>{{ old('shipping_address') }}</textarea>
                </div>
                <div class="field full">
                    <label>Notes</label>
                    <textarea name="notes">{{ old('notes') }}</textarea>
                </div>
                <div class="field full">
                    <button class="btn" type="submit">Place order</button>
                </div>
            </form>
        </div>
        <aside class="card">
            <div class="card-body">
                <h2>Order Summary</h2>
                @foreach($cart['items'] as $item)
                    <p>{{ $item['quantity'] }} x {{ $item['name'] }} <strong>${{ number_format($item['line_total'], 2) }}</strong></p>
                @endforeach
                <p>Shipping: ${{ number_format($cart['shipping'], 2) }}</p>
                <p class="price">${{ number_format($cart['total'], 2) }}</p>
            </div>
        </aside>
    </section>
@endsection
