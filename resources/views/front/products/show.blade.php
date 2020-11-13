@extends('front._layout')

@section('title', 'خانه')

@section('page-styles')
    <link rel="stylesheet" href="{{ fh(asset('css/front/products.css')) }}">
@endsection

@section('main')
    <article class="container persian text-right">
        <div class="row">
            <div class="col">
                <h1>{{ $product->title }}</h1>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <h2>{{ 'تصاویر ' . $product->title }}</h2>
            </div>
        </div>
        <div class="row">
            @if($photos = $product->photos())
                @foreach($photos as $photo)
                    <div class="col-md-3 pb-4">
                        <p class="product">
                            <img src="{{ photoUrl($photo) }}" class="img-fluid" alt="{{ $product->title }}">
                        </p>
                    </div>
                @endforeach
            @else
                <div class="col">
                    <p class="py-2 px-5 bg-info">این محصول تصویر ندارد.</p>
                </div>
            @endif
        </div>
        <div class="row">
            <div class="col">
                <h2>{{ 'محصول ' . $product->title }}</h2>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <p>{{ $product->content }}</p>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <h2>{{ 'خرید ' . $product->title }}</h2>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <p>{{ $product->content }}</p>
            </div>
        </div>
    </article>
@endsection