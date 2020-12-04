@extends('front.auth.otp._layout')

@section('title', 'ورود / نام‌نویسی')

@section('headline', 'ورود / نام‌نویسی')

@section('form')
    <form method="post" action="{{ route('auth.otp.generate') }}">
        <div class="form-group">
            <label>شماره همراه:</label>
            <input type="text" name="cellphone" title="" class="form-control ltr" required pattern="^09[0-9]{9}$"
                   value="{{ old('cellphone') ?? request('cellphone') }}">
        </div>
        <div class="form-group">
            @csrf
            <button class="btn btn-block btn-primary">دریافت کد تایید</button>
        </div>
    </form>
@endsection
