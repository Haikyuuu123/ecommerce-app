@extends('layouts.admin')

@section('content')
    <div class="section-title">
        <h1>Order #{{ $order->id }}</h1>
        <a class="btn secondary" href="{{ route('admin.orders.index') }}">Back</a>
    </div>
    <div class="split">
        <section>
            <table>
                <thead><tr><th>Product</th><th>Price</th><th>Qty</th><th>Total</th></tr></thead>
                <tbody>
                    @foreach($order->items as $item)
                        <tr>
                            <td>{{ $item->product_name }}</td>
                            <td>${{ number_format($item->price, 2) }}</td>
                            <td>{{ $item->quantity }}</td>
                            <td>${{ number_format($item->line_total, 2) }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </section>
        <aside class="card">
            <div class="card-body">
                <h2>{{ $order->customer_name }}</h2>
                <p>{{ $order->customer_email }}</p>
                <p>{{ $order->customer_phone }}</p>
                <p>{{ $order->shipping_address }}</p>
                <p class="price">${{ number_format($order->total, 2) }}</p>
                <form method="POST" action="{{ route('admin.orders.status', $order) }}">
                    @csrf
                    @method('PATCH')
                    <div class="field">
                        <label>Status</label>
                        <select name="status">
                            @foreach(['pending', 'processing', 'shipped', 'completed', 'cancelled'] as $status)
                                <option value="{{ $status }}" @selected($order->status === $status)>{{ ucfirst($status) }}</option>
                            @endforeach
                        </select>
                    </div>
                    <br>
                    <button class="btn" type="submit">Update status</button>
                </form>
            </div>
        </aside>
    </div>
@endsection
