@extends('admin.master')

@section('title', 'Category')

@section('content')
    {{-- <x-input name="email" type="email" label="Địa chỉ Email" placeholder="Nhập email của bạn..." /> --}}
    <a href="{{ route('admin.categories.create') }}" {{-- href="#" --}} class="btn btn-primary mb-3">
        Add Category
    </a>

    <table class="table table-bordered table-hover">
        <thead>
            <tr>
                <th>ID</th>
                <th>Category Name</th>
                <th>Slug</th>
                <th>Actions</th>
            </tr>
        </thead>
        {{-- @dd($categories) --}}
        <tbody>
            @foreach ($categories as $category)
                <tr>
                    <td>{{ $category->id }}</td>
                    <td>{{ $category->name }}</td>
                    <td>{{ $category->slug }}</td>
                    <td>
                        <a href="{{ route('admin.categories.edit', $category) }}"  class="btn btn-sm btn-warning">
                            Edit
                        </a>
                        <form {{-- action="{{ route('admin.categories.destroy', $category) }}"  --}} method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger" onclick="return confirm('Confirm delete?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{ $categories->links() }}
    
@endsection
