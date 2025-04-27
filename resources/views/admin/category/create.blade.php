@extends('admin.master')

@section('title', 'Create Category')

@section('content')
    <form action="{{ route('admin.categories.store') }}" method="POST">
        @include('admin.category.form')
    </form>
@endsection