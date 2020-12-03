@extends('front._layout')

@section('title', $title)

@section('description', $description)

@section('page-styles')
    <link rel="stylesheet" href="{{ fh(asset('css/front/products.css')) }}">
@endsection

@section('main')
    <div class="container products persian">
        <div class="row">
            <div class="col text-right">
                <h1>{{ $headline ?? $title }}</h1>
            </div>
        </div>
        <hr>
        <div class="row">
            @foreach($products as $product)
                <article class="col-sm-6 col-md-4 col-lg-3 pb-4">
                    <p>
                        <a href="{{ route('products.show', [$product]) }}" class="product">
                            <img src="{{ photoUrl($product->photo()) }}" class="img-fluid" alt="{{ $product->title }}">
                            <i class="info">
                                <span>قیمت:</span>
                                <span class="price">{{ number_format($product->price / 10) }}</span>
                                <span class="unit">تومان</span>
                            </i>
                        </a>
                    </p>
                </article>
            @endforeach
        </div>
    </div>
@endsection
