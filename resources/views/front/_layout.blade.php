@extends('front._html')

@section('styles')
    <link rel="stylesheet" href="{{ fh(asset('css/front/layout.css')) }}">
    @yield('page-styles')
@endsection

@section('body')
    <div class="container mt-5">
        <header class="row">
            <div class="col-md-10 persian text-right">
                <a class="h2" href="{{ route('home') }}">اسپورتی شاپ</a>
                <p>فروشگاه لوازم رزمی و پوشاک ورزشی با ارسال رایگان به سراسر کشور</p>
                <nav>
                    <label class="text-center">
                        <span class="d-block mb-1">محصولات</span>
                        <a href="{{ route('home') }}" class="btn btn-block btn-outline-secondary">
                            <i class="fas fa-folder-open"></i>
                            <span>{{ $totalProductCount }}</span>
                        </a>
                    </label>
                    <label class="text-center">
                        <span class="d-block mb-1">پروفایل شما</span>
                        <a href="#" class="btn btn-block btn-outline-secondary">
                            <i class="fas fa-user"></i>
                            <span>ورود/نام‌نویسی</span>
                        </a>
                    </label>
                    <label class="text-center">
                        <span class="d-block mb-1">سبد خرید</span>
                        <a href="#" class="btn btn-block btn-outline-secondary">
                            <i class="fas fa-shopping-cart"></i>
                            <span>(0)</span>
                        </a>
                    </label>
                </nav>
            </div>
            <div class="col-md-2">
                <img src="{{ asset('img/logo.png') }}" class="img-fluid" alt="لوگوی اسپورتی شاپ">
            </div>
        </header>
        <hr>
    </div>

    @yield('main')

    <div class="container mt-3 mb-5">
        <hr>
        <footer>
            <div class="row">
                <nav class="col text-center persian">
                    <a href="{{ route('home') }}" class="text-muted">خانه</a>
                    <a href="#" class="text-muted">شرایط استفاده</a>
                    <a href="#" class="text-muted">حریم شخصی</a>
                    <a href="#" class="text-muted">درباره ما</a>
                    <a href="#" class="text-muted">ارتباط با ما</a>
                </nav>
            </div>
            <div class="row mt-2">
                <nav class="col text-center persian">
                    تمامی حقوق این تارنما ازآن «اسپورتی شاپ» می‌باشد.
                </nav>
            </div>
        </footer>
    </div>
@endsection
