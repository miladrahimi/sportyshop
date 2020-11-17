@extends('front._layout')

@section('main')
    <div class="container">
        <div class="row">
            <div class="col-sm-6 offset-sm-3 col-md-4 offset-md-4">
                <div class="card persian text-right">
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
