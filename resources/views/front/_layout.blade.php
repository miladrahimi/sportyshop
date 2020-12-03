@extends('front._html')

@section('styles')
    <link rel="stylesheet" href="{{ fh(asset('css/front/layout.css')) }}">
    @yield('page-styles')
@endsection

@section('body')
    <div class="container mt-5">
        <header class="row">
            <div class="col-md-3 col-lg-2 pb-2 text-center text-md-left">
                <a href="{{ route('home') }}">
                    <img src="{{ asset('img/logo.png') }}" class="img-fluid logo" alt="لوگوی اسپورتی شاپ">
                </a>
            </div>
            <div class="col-md-9 col-lg-10 persian text-center text-md-right">
                <a class="h2" href="{{ route('home') }}">اسپورتی شاپ</a>
                <p>
                    <span class="d-block d-sm-inline">فروشگاه لوازم رزمی و پوشاک ورزشی</span>
                    <span class="d-block d-sm-inline">با امکان ارسال پستی به سراسر کشور</span>
                </p>
                <nav>
                    <label class="text-center d-block d-sm-inline-block">
                        <span class="d-block mb-1">محصولات</span>
                        <a href="{{ route('products.index') }}" class="btn btn-block btn-outline-secondary">
                            <i class="fas fa-folder-open"></i>
                            <span>({{ $totalProductCount }})</span>
                        </a>
                    </label>
                    <label class="text-center d-block d-sm-inline-block">
                        <span class="d-block mb-1">پروفایل من</span>
                        @if($u = auth()->user())
                            <a href="{{ route('account.profile.show') }}" class="btn btn-block btn-outline-secondary">
                                <i class="fas fa-user"></i>
                                <span>{{ $u->cellphone }}</span>
                            </a>
                        @else
                            <a href="{{ route('auth.otp.show') }}" class="btn btn-block btn-outline-secondary">
                                <i class="fas fa-user"></i>
                                <span>ورود/نام‌نویسی</span>
                            </a>
                        @endif
                    </label>
                    <label class="text-center d-block d-sm-inline-block">
                        <span class="d-block mb-1">سبد خرید</span>
                        <a href="{{ route('card.index') }}" class="btn btn-block btn-outline-secondary">
                            <i class="fas fa-shopping-cart"></i>
                            <span>(0)</span>
                        </a>
                    </label>
                </nav>
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
                    <a href="{{ route('home') }}" class="text-muted d-inline-block">خانه</a>
                    <a href="#" class="text-muted d-inline-block">شرایط استفاده</a>
                    <a href="#" class="text-muted d-inline-block">حریم شخصی</a>
                    <a href="#" class="text-muted d-inline-block">درباره ما</a>
                    <a href="#" class="text-muted d-inline-block">ارتباط با ما</a>
                </nav>
            </div>
            <div class="row mt-2">
                <p class="col text-center persian">
                    <span class="d-block d-sm-inline">تمامی حقوق این وب‌سایت</span>
                    <span class="d-block d-sm-inline">ازآن «اسپورتی شاپ» می‌باشد.</span>
                </p>
            </div>
        </footer>
    </div>
@endsection
