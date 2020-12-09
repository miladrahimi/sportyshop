@extends('front._layout')

@section('title', 'درباره ما')

@section('description', trans('e.home-description'))

@section('headline', 'درباره ما')

@section('page-styles')
    <style>
        h2, h3 {
            font-size: medium;
            margin: 0 0 15px 0;
            text-align: center;
        }

        .links {
            direction: ltr;
            font-size: x-large;
        }

        .avatar {
            width: 120px;
            height: auto;
            border-radius: 50%;
            border: solid 3px rgb(255, 126, 0);
        }
    </style>
@endsection

@section('main')
    <article class="container">
        <div class="row">
            <div class="col text-center">
                <p>
                    <img src="{{ asset('img/logo512.png') }}" width="120px" height="auto" alt="اسپرتات">
                </p>
                <h2>اسپرتات</h2>
                <p class="text-muted">فروشگاه اینترنتی لوازم رزمی و پوشاک ورزشی</p>
                <p class="text-justify">
                    اسپرتات یک فروشگاه اینترنتی است که در پاییز سال ۱۳۹۹ آغاز به فعالیت نموده است.
                    فروشگاه اینترنتی اسپرتات در زمینه فروش و تولید محصولات ورزشی و به ویژه لوازم رزمی،
                    کالای های با کیفیت برای مشتریان فراهم می کند.
                    اسپرتات علاوه بر فروش محصولات ورزشی
                    (لوازم رزمی، پوشاک مردانه و زنانه، وسایل مورد نیاز باشگاه های ورزشی و ...)
                    از برند های معتبر داخلی و خارجی، محصولات سفارشی مورد نیاز مشتریان را نیز تولید می کند.
                </p>
                <p class="links">
                    <a href="{{ route('home') }}"><i class="fas fa-globe"></i></a>
                    <a href="https://www.instagram.com/sportat.ir/"><i class="fab fa-instagram"></i></a>
                    <a href="mailto:info@sportat.ir"><i class="far fa-envelope-open"></i></a>
                </p>
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col-sm-6 text-center">
                <p>
                    <img src="{{ fh(asset('img/milad-rahimi.jpg')) }}" class="avatar" alt="میلاد رحیمی">
                </p>
                <h3>میلاد رحیمی</h3>
                <p class="text-muted">مدیر فروشگاه اسپرتات</p>
                <p class="links">
                    <a href="https://miladrahimi.com"><i class="fas fa-globe"></i></a>
                    <a href="https://www.instagram.com/realmiladrahimi"><i class="fab fa-instagram"></i></a>
                    <a href="https://twitter.com/realmiladrahimi"><i class="fab fa-twitter"></i></a>
                    <a href="https://www.linkedin.com/in/realmiladrahimi/"><i class="fab fa-linkedin"></i></a>
                    <a href="mailto:info@miladrahimi.com"><i class="far fa-envelope-open"></i></a>
                </p>
            </div>
            <div class="col-sm-6 text-center">
                <p>
                    <img src="{{ fh(asset('img/behzad-rahimi.jpg')) }}" class="avatar" alt="میلاد رحیمی">
                </p>
                <h3>بهزاد رحیمی</h3>
                <p class="text-muted">مدیر فروشگاه اسپرتات</p>
                <p class="links">
                    <a href="https://twitter.com/BehzadRahimix"><i class="fab fa-twitter"></i></a>
                    <a href="mailto:b7rahimi@gmail.com"><i class="far fa-envelope-open"></i></a>
                </p>
            </div>
        </div>
    </article>
@endsection
