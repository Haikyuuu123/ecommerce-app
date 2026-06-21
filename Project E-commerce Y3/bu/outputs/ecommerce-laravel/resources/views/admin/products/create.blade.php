@extends('layouts.admin')

@section('content')
    <h1>New Product</h1>
    <form method="POST" action="{{ route('admin.products.store') }}">
        @include('admin.products.form')
    </form>
@endsection
