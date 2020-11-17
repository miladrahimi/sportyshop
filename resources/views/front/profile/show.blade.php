@extends('front._layout')

@section('title', 'پروفایل شما')

@section('main')
    <div class="container">
        <div class="row">
            <div class="col-sm-6 offset-sm-3 col-md-4 offset-md-4">
                <div class="card persian text-right">
                    <div class="card-header">@yield('title')</div>
                    <div class="card-body">
                        @include('front._alerts')
                        <form method="post" action="{{ route('profile.update') }}">
                            <div class="form-group">
                                <label>شماره همراه:</label>
                                <input type="text" title="" class="form-control ltr" value="{{ $user->cellphone }}"
                                       disabled readonly>
                            </div>
                            <div class="form-group">
                                <label>نام:</label>
                                <input type="text" name="firstName" title="" class="form-control persian"
                                       value="{{ $user->first_name }}">
                            </div>
                            <div class="form-group">
                                <label>نام خانوادگی:</label>
                                <input type="text" name="lastName" title="" class="form-control persian"
                                       value="{{ $user->last_name }}">
                            </div>
                            <div class="form-group">
                                @csrf
                                <button class="btn btn-block btn-primary">بروزرسانی</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
