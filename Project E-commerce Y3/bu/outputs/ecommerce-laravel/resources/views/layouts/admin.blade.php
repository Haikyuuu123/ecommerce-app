<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin - {{ config('app.name') }}</title>
    <link rel="stylesheet" href="{{ asset('css/shop.css') }}">
</head>
<body>
    <header class="topbar">
        <nav class="nav">
            <a class="brand" href="{{ route('admin.dashboard') }}">Admin Dashboard</a>
            <div class="nav-links">
                <a href="{{ route('admin.products.index') }}">Products</a>
                <a href="{{ route('admin.categories.index') }}">Categories</a>
                <a href="{{ route('admin.orders.index') }}">Orders</a>
                <a href="{{ route('store.home') }}">Storefront</a>
            </div>
        </nav>
    </header>

    <main class="container">
        @if(session('success'))
            <div class="alert success">{{ session('success') }}</div>
        @endif
        @if($errors->any())
            <div class="alert error">{{ $errors->first() }}</div>
        @endif
        @yield('content')
    </main>
</body>
</html>
