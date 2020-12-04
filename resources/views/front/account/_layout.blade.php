@extends('front._layout')

@section('headline', 'حساب کاربری')

@section('page-styles')
    <style type="text/css">
        aside .list-group .list-group-item.active a {
            color: white;
        }
    </style>
@endsection

@section('main')
    <div class="container">
        <div class="row">
            <aside class="col-md-4 mb-2">
                <ul class="list-group p-0">
                    <li class="list-group-item active">
                        <a href="{{ route('account.profile.show') }}">پروفایل من</a>
                    </li>
                    <li class="list-group-item">
                        <a href="#">سفارش های من</a>
                    </li>
                    <li class="list-group-item">
                        <a href="{{ route('account.sign-out.do') }}">بیرون رفتن</a>
                    </li>
                </ul>
            </aside>
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">@yield('title')</div>
                    <div class="card-body">
                        @include('front._alerts')
                        @yield('form')
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
