@extends('layouts.admin')

@section('content')
    <div class="section-title">
        <h1>Dashboard</h1>
    </div>

    <div class="stats">
        <div class="stat"><span>Products</span><strong>{{ $stats['products'] }}</strong></div>
        <div class="stat"><span>Categories</span><strong>{{ $stats['categories'] }}</strong></div>
        <div class="stat"><span>Orders</span><strong>{{ $stats['orders'] }}</strong></div>
        <div class="stat"><span>Revenue</span><strong>${{ number_format($stats['revenue'], 2) }}</strong></div>
    </div>

    <br>
    <div class="split">
        <section>
            <h2>Recent Orders</h2>
            <table>
                <thead><tr><th>ID</th><th>Customer</th><th>Total</th><th>Status</th></tr></thead>
                <tbody>
                    @forelse($recentOrders as $order)
                        <tr>
                            <td><a href="{{ route('admin.orders.show', $order) }}">#{{ $order->id }}</a></td>
                            <td>{{ $order->customer_name }}</td>
                            <td>${{ number_format($order->total, 2) }}</td>
                            <td>{{ ucfirst($order->status) }}</td>
                        </tr>
                    @empty
                        <tr><td colspan="4">No orders yet.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </section>
        <section>
            <h2>Low Stock</h2>
            <table>
                <thead><tr><th>Product</th><th>Stock</th></tr></thead>
                <tbody>
                    @forelse($lowStockProducts as $product)
                        <tr><td>{{ $product->name }}</td><td>{{ $product->stock }}</td></tr>
                    @empty
                        <tr><td colspan="2">Stock levels look good.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </section>
    </div>
@endsection
