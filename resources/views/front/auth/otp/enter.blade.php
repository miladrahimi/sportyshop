@extends('front.auth.otp._layout')

@section('title', 'ورود / نام‌نویسی')

@section('headline', 'ورود / نام‌نویسی')

@section('form')
    <form method="post" action="{{ route('auth.otp.submit') }}">
        <div class="form-group">
            <label>شماره همراه:</label>
            <input type="text" title="" class="form-control ltr" value="{{ $cellphone }}" readonly>
        </div>
        <div class="form-group">
            <label>کد دریافتی:</label>
            <span id="ttl" class="badge badge-warning" data-seconds="{{ $ttl }}">---</span>
            <input type="text" name="code" title="" class="form-control ltr" required pattern="[0-9]{6}">
        </div>
        <div class="form-group">
            @csrf
            <button class="btn btn-block btn-primary" id="submit">تایید کد دریافتی</button>
            <a href="{{ route('auth.otp.show', ['cellphone' => $cellphone]) }}" id="resend"
               class="btn btn-block btn-info" style="display: none">تلاش مجدد</a>
            <a href="{{ route('auth.otp.show') }}"
               class="btn btn-block btn-outline-secondary">ویرایش شماره همراه</a>
        </div>
    </form>
@endsection

@section('scripts')
    <script>
        $(document).ready(function () {
            let ttl = $('#ttl');
            let seconds = parseInt(ttl.data('seconds'));
            let counter = setInterval(function () {
                if (seconds > 0) {
                    seconds--;
                    ttl.html(Math.floor(seconds / 60) + ':' + (seconds % 60));
                } else {
                    clearInterval(counter);
                    $('#submit').hide();
                    $('#resend').show();
                }
            }, 1000);
        });
    </script>
@endsection
