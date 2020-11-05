@extends('admin._html')

@section('styles')
    <link rel="stylesheet" href="{{ fh(asset('css/admin/layout.css')) }}">
    @yield('page-styles')
@endsection

@section('body')
    <div class="container py-2">
        <nav class="d-flex justify-content-center rtl mb-3">
            <a href="{{ route('admin.home.show') }}" data-to="home">خانه</a>
            <a href="{{ route('admin.products.index') }}" data-to="products">محصولات</a>
            <a href="#" data-to="orders">سفارش‌ها</a>
            <a href="{{ route('admin.auth.sign-out.do') }}">خروج</a>
        </nav>

        @include('_alerts')

        @yield('main')
    </div>
@endsection
