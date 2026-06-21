@extends('layouts.admin')

@section('content')
    <div class="section-title">
        <h1>Categories</h1>
        <a class="btn" href="{{ route('admin.categories.create') }}">New category</a>
    </div>
    <table>
        <thead><tr><th>Name</th><th>Products</th><th>Status</th><th></th></tr></thead>
        <tbody>
            @foreach($categories as $category)
                <tr>
                    <td>{{ $category->name }}</td>
                    <td>{{ $category->products_count }}</td>
                    <td>{{ $category->is_active ? 'Active' : 'Hidden' }}</td>
                    <td class="actions">
                        <a class="btn secondary" href="{{ route('admin.categories.edit', $category) }}">Edit</a>
                        <form method="POST" action="{{ route('admin.categories.destroy', $category) }}">
                            @csrf
                            @method('DELETE')
                            <button class="btn danger" type="submit">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div class="pagination">{{ $categories->links() }}</div>
@endsection
