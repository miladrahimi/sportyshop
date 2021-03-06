@extends('admin._html')

@section('styles')
    <link rel="stylesheet" href="{{ fh(asset('css/admin/layout.css')) }}">
    @yield('page-styles')
@endsection

@section('body')
    <div class="container py-2">
        <nav class="d-flex bg-secondary justify-content-center mb-3">
            <a href="{{ route('admin.home.show') }}" data-to="home">Home</a>
            <a href="{{ route('admin.products.index') }}" data-to="products">Products</a>
            <a href="#" data-to="orders">Orders</a>
            <a href="{{ route('admin.auth.sign-out.do') }}">Sign Out</a>
        </nav>

        @include('admin._alerts')

        @yield('main')
    </div>
@endsection
