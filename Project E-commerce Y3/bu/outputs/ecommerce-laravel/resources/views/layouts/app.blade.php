<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name') }}</title>
    <link rel="stylesheet" href="{{ asset('css/shop.css') }}">
</head>
<body>
    <header class="topbar">
        <nav class="nav">
            <a class="brand" href="{{ route('store.home') }}">Laravel Shop</a>
            <div class="nav-links">
                <a href="{{ route('store.products') }}">Products</a>
                <a href="{{ route('cart.index') }}">Cart ({{ count(session('cart', [])) }})</a>
                <a href="{{ route('admin.dashboard') }}">Admin</a>
            </div>
        </nav>
    </header>

    <main>
        @if(session('success'))
            <div class="container"><div class="alert success">{{ session('success') }}</div></div>
        @endif
        @if(session('error'))
            <div class="container"><div class="alert error">{{ session('error') }}</div></div>
        @endif
        @if($errors->any())
            <div class="container"><div class="alert error">{{ $errors->first() }}</div></div>
        @endif

        @yield('content')
    </main>
</body>
</html>
