@extends('layouts.admin')

@section('content')
    <h1>Edit Product</h1>
    <form method="POST" action="{{ route('admin.products.update', $product) }}">
        @method('PUT')
        @include('admin.products.form')
    </form>
@endsection
