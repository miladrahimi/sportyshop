@extends('front.account._layout')

@section('title', 'پروفایل من')

@section('form')
    <form method="post" action="{{ route('account.profile.update') }}">
        <div class="form-group">
            <label>شماره همراه:</label>
            <input type="text" title="" class="form-control ltr" value="{{ $user->cellphone }}" disabled readonly>
        </div>
        <div class="form-group">
            <label>نام:</label>
            <input type="text" name="firstName" title="" class="form-control" value="{{ $user->first_name }}">
        </div>
        <div class="form-group">
            <label>نام خانوادگی:</label>
            <input type="text" name="lastName" title="" class="form-control" value="{{ $user->last_name }}">
        </div>
        <div class="form-group">
            @csrf
            <button class="btn btn-block btn-primary">بروزرسانی</button>
        </div>
    </form>
@endsection

@section('scripts')
    <script>
        $('#nav_profile').addClass('active');
    </script>
@endsection
