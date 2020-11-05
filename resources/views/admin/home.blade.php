@extends('admin._layout')

@section('title', 'خانه')

@section('main')
    <main class="text-center p-5">
        <img src="{{ asset('img/logo.png') }}" alt="logo" class="img-fluid">
    </main>
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            $('nav a[data-to="home"]').addClass('active');
        });
    </script>
@endsection
