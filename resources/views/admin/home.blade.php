@extends('admin._layout')

@section('title', 'Home')

@section('main')
    <main class="text-center p-5 bg-light">
        <img src="{{ fh(asset('img/logo.png')) }}" alt="logo" class="img-fluid">
    </main>
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            $('nav a[data-to="home"]').addClass('active');
        });
    </script>
@endsection
