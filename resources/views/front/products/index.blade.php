@extends('front._layout')

@section('title', $title)

@section('description', $description)

@section('headline', $headline ?? $title)

@section('page-styles')
    <link rel="stylesheet" href="{{ fh(asset('css/front/products.css')) }}">
@endsection

@section('main')
    <div class="container products persian">
        <div class="row">
            @foreach($products as $product)
                <article class="col-6 col-md-4 col-lg-3 pb-4">
                    <p>
                        <a href="{{ route('products.show', [$product]) }}" class="product">
                            <img src="{{ photoUrl($product->photo()) }}" class="img-fluid" alt="{{ $product->title }}">
                            <i class="info bg-secondary">
                                <span class="d-none d-sm-inline">قیمت:</span>
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
