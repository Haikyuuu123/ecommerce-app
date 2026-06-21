@extends('layouts.app')

@section('content')
    <section class="container">
        <div class="card">
            <div class="card-body">
                <h1>Order received</h1>
                <p>Thank you, {{ $order->customer_name }}. Your order number is #{{ $order->id }}.</p>
                <p class="price">Total: ${{ number_format($order->total, 2) }}</p>
                <a class="btn" href="{{ route('store.products') }}">Keep shopping</a>
            </div>
        </div>
    </section>
@endsection
