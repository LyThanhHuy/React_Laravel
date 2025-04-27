@extends('admin.master')

@section('title', 'Edit Category')

@section('content')
    <form action="{{ route('admin.categories.update', $category) }}" method="POST">
        @csrf
        @method('PUT')
        @include('admin.category.form')
    </form>
@endsection
