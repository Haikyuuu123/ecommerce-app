@extends('layouts.app')

@section('content')
    <section class="hero">
        <div class="hero-inner">
            <h1>Modern products, simple shopping.</h1>
            <p>Browse featured items, add products to your cart, and place an order through a full Laravel and MySQL CRUD project.</p>
            <a class="btn" href="{{ route('store.products') }}">Shop products</a>
        </div>
        <div class="hero-media">
            <img src="https://images.unsplash.com/photo-1519389950473-47ba0277781c?auto=format&fit=crop&w=1000&q=80" alt="Online store workspace">
        </div>
    </section>

    <section class="container">
        <div class="section-title">
            <h2>Featured Products</h2>
            <a class="btn secondary" href="{{ route('store.products') }}">View all</a>
        </div>
        <div class="grid">
            @forelse($featuredProducts as $product)
                @include('store.partials.product-card', ['product' => $product])
            @empty
                <p class="muted">No featured products yet. Add products from the admin dashboard.</p>
            @endforelse
        </div>
    </section>

    <section class="container">
        <div class="section-title"><h2>Categories</h2></div>
        <div class="grid">
            @foreach($categories as $category)
                <a class="card" href="{{ route('store.products', ['category' => $category->slug]) }}">
                    <div class="card-body">
                        <h3>{{ $category->name }}</h3>
                        <p class="muted">{{ $category->products_count }} products</p>
                    </div>
                </a>
            @endforeach
        </div>
    </section>
@endsection
