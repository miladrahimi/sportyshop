@extends('front._layout')

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
            <div class="col-md-8">
                <div class="card persian text-right">
                    <div class="card-header">@yield('title')</div>
                    <div class="card-body">
                        @include('front._alerts')
                        @yield('form')
                    </div>
                </div>
            </div>
            <aside class="col-md-4">
                <ul class="list-group persian text-right">
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
        </div>
    </div>
@endsection
