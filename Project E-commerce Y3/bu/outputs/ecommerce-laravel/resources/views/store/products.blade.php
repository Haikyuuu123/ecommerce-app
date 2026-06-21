@extends('layouts.app')

@section('content')
    <section class="container">
        <div class="section-title">
            <h1>Products</h1>
        </div>
        <form class="form-grid" method="GET" action="{{ route('store.products') }}">
            <div class="field">
                <label>Search</label>
                <input name="search" value="{{ request('search') }}" placeholder="Product name">
            </div>
            <div class="field">
                <label>Category</label>
                <select name="category">
                    <option value="">All categories</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->slug }}" @selected(request('category') === $category->slug)>{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="field full">
                <button class="btn" type="submit">Filter products</button>
            </div>
        </form>
    </section>

    <section class="container">
        <div class="grid">
            @forelse($products as $product)
                @include('store.partials.product-card', ['product' => $product])
            @empty
                <p class="muted">No products found.</p>
            @endforelse
        </div>
        <div class="pagination">{{ $products->links() }}</div>
    </section>
@endsection
