@extends('front._layout')

@section('title', 'درباره ما')

@section('description', trans('e.home-description'))

@section('headline', 'درباره ما')

@section('page-styles')
    <style>
        h2 {
            font-size: medium;
            margin: 0 0 15px 0;
            text-align: center;
        }
    </style>
@endsection

@section('main')
    <article class="container">
        <div class="row">
            <div class="col">
                <p class="text-center">
                    <img src="{{ asset('img/logo512.png') }}" width="120px" height="auto" alt="اسپرتات">
                </p>
                <h2>اسپرتات</h2>
                <p></p>
            </div>
        </div>
    </article>
@endsection

@section('scripts')

@endsection
