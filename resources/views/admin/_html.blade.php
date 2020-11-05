<!doctype html>
<html lang="fa">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @yield('meta')
    <title>{{ 'تایسون اسپورت' }} - {{ 'مدیریت' }} - @yield('title')</title>
    <link rel="apple-touch-icon" href="{{ asset('favicon.ico') }}">
    <link rel="icon" href="{{ asset('favicon.ico') }}">
    <link rel="stylesheet" href="{{ asset('vendor/bootstrap-4.5.2/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/fontawesome-5.12.0/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ fh(asset('css/general.css')) }}">
    @yield('styles')
</head>
<body class="text-right">

@yield('body')

<script src="{{ asset('vendor/jquery-3.5.1.min.js') }}"></script>
<script src="{{ asset('vendor/popper.min.js') }}"></script>
<script src="{{ asset('vendor/bootstrap-4.5.2/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('vendor/fontawesome-5.12.0/js/all.min.js') }}"></script>
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
</script>
@yield('scripts')

</body>
</html>
