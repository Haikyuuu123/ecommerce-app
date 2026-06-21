@extends('layouts.admin')

@section('content')
    <h1>New Category</h1>
    <form method="POST" action="{{ route('admin.categories.store') }}">
        @include('admin.categories.form')
    </form>
@endsection
