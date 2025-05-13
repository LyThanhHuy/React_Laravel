@extends('admin.master')

@section('title', 'Order')

@section('content')
    <a {{-- href="{{ route('admin.products.create') }}"  --}} href="#" class="btn btn-primary mb-3">
        Add Order
    </a>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @elseif(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>User</th>
                <th>Status</th>
                <th>Total Price</th>
                <th>Created At</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            
        </tbody>
    </table>
@endsection
