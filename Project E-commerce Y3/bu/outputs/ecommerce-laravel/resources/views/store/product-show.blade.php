@extends('layouts.app')

@section('content')
    <section class="container split">
        <div class="card">
            <img class="product-image" src="{{ $product->image_url ?: 'https://images.unsplash.com/photo-1556742049-0cfed4f6a45d?auto=format&fit=crop&w=1000&q=80' }}" alt="{{ $product->name }}">
        </div>
        <div>
            <p class="muted">{{ $product->category->name }}</p>
            <h1>{{ $product->name }}</h1>
            <p class="price">${{ number_format($product->price, 2) }}</p>
            <p>{{ $product->description }}</p>
            <p class="muted">{{ $product->stock }} in stock</p>
            <form method="POST" action="{{ route('cart.store', $product) }}">
                @csrf
                <div class="field">
                    <label>Quantity</label>
                    <input type="number" name="quantity" value="1" min="1" max="{{ max(1, $product->stock) }}">
                </div>
                <br>
                <button class="btn" type="submit">Add to cart</button>
            </form>
        </div>
    </section>
@endsection
