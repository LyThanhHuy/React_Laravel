@extends('admin.master')

@section('title', 'Create Product')

@section('content')
    <form 
        action="{{ route('admin.products.store') }}"
        method="POST"
    >
        @include('admin.products.form')
    </form>
@endsection