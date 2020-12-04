@extends('front._layout')

@section('main')
    <div class="container">
        <div class="row">
            <div class="col-sm-3 col-md-4"></div>
            <div class="col-sm-6 col-md-4">
                <div class="card">
                    <div class="card-body">
                        @yield('form')
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
