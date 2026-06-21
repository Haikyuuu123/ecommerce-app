@extends('layouts.admin')

@section('content')
    <h1>Orders</h1>
    <table>
        <thead><tr><th>ID</th><th>Customer</th><th>Total</th><th>Status</th><th>Created</th><th></th></tr></thead>
        <tbody>
            @foreach($orders as $order)
                <tr>
                    <td>#{{ $order->id }}</td>
                    <td>{{ $order->customer_name }}<br><span class="muted">{{ $order->customer_email }}</span></td>
                    <td>${{ number_format($order->total, 2) }}</td>
                    <td>{{ ucfirst($order->status) }}</td>
                    <td>{{ $order->created_at->format('M d, Y') }}</td>
                    <td><a class="btn secondary" href="{{ route('admin.orders.show', $order) }}">View</a></td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div class="pagination">{{ $orders->links() }}</div>
@endsection
