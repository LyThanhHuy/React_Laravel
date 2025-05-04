@extends('admin.master')

@section('title', 'Product')

@section('content')
    <a href="{{ route('admin.products.create') }}" class="btn btn-primary mb-3">
        Add Product
    </a>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Name</th>
                <th>Price</th>
                <th>Stock</th>
                <th>Category</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($products as $p)
                <tr>
                    <td>{{ $p->name }}</td>
                    <td>{{ number_format($p->price) }}</td>
                    <td>{{ $p->stock }}</td>
                    <td>{{ $p->category->name ?? '-' }}</td>
                    <td>
                        <a href="{{ route('admin.products.edit', $p) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('admin.products.destroy', $p) }}" method="POST" style="display:inline-block">
                            @csrf @method('DELETE')
                            <button onclick="return confirm('Are you sure?')" class="btn btn-danger btn-sm">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
