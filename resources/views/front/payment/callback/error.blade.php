@extends('front._layout')

@section('title', 'خطای درگاه بانکی')

@section('headline', 'خطای درگاه بانکی')

@section('main')
    <div class="container">
        <div class="row">
            <div class="col">
                <p class="bg-danger p-5 text-white mb-0">{{ $error }}</p>
            </div>
        </div>
    </div>
@endsection
