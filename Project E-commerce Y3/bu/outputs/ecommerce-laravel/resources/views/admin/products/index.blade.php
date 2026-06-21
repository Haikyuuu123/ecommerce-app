@extends('layouts.admin')

@section('content')
    <div class="section-title">
        <h1>Products</h1>
        <a class="btn" href="{{ route('admin.products.create') }}">New product</a>
    </div>
    <table>
        <thead><tr><th>Name</th><th>Category</th><th>Price</th><th>Stock</th><th>Status</th><th></th></tr></thead>
        <tbody>
            @foreach($products as $product)
                <tr>
                    <td>{{ $product->name }}</td>
                    <td>{{ $product->category->name }}</td>
                    <td>${{ number_format($product->price, 2) }}</td>
                    <td>{{ $product->stock }}</td>
                    <td>{{ $product->is_active ? 'Active' : 'Hidden' }}</td>
                    <td class="actions">
                        <a class="btn secondary" href="{{ route('admin.products.edit', $product) }}">Edit</a>
                        <form method="POST" action="{{ route('admin.products.destroy', $product) }}">
                            @csrf
                            @method('DELETE')
                            <button class="btn danger" type="submit">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div class="pagination">{{ $products->links() }}</div>
@endsection
