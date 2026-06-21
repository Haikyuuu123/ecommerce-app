<article class="card">
    <a href="{{ route('store.products.show', $product) }}">
        <div class="product-thumb">
            <img class="product-image" src="{{ $product->image_url ?: 'https://images.unsplash.com/photo-1556742049-0cfed4f6a45d?auto=format&fit=crop&w=800&q=80' }}" alt="{{ $product->name }}">
        </div>
    </a>
    <div class="card-body">
        <p class="muted">{{ $product->category->name }}</p>
        <h3><a href="{{ route('store.products.show', $product) }}">{{ $product->name }}</a></h3>
        <p class="price">${{ number_format($product->price, 2) }}</p>
        <form method="POST" action="{{ route('cart.store', $product) }}">
            @csrf
            <input type="hidden" name="quantity" value="1">
            <button class="btn" type="submit">Add to cart</button>
        </form>
    </div>
</article>
