@extends('admin.master')

@section('title', 'Edit Product')

@section('content')
    <form action="{{ route('admin.products.update', $product) }}" method="POST">
        @csrf
        @method('PUT')
        @include('admin.products.form')
    </form>
@endsection
