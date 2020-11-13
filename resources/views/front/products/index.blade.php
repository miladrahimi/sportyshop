@extends('front._layout')

@section('title', 'خانه')

@section('page-styles')
    <link rel="stylesheet" href="{{ fh(asset('css/front/products.css')) }}">
@endsection

@section('main')
    <div class="container products persian">
        <div class="row">
            @foreach($products as $product)
                <article class="col-md-3 pb-4">
                    <p>
                        <a href="{{ route('products.show', [$product]) }}" class="product">
                            <img src="{{ photoUrl($product->photo()) }}" class="img-fluid" alt="{{ $product->title }}">
                            <i class="info">
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
