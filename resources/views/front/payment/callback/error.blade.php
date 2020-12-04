@extends('front._layout')

@section('title', 'خطای درگاه بانکی')

@section('main')
    <div class="container persian">
        <div class="row">
            <div class="col text-right">
                <h1>خطای درگاه بانکی</h1>
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col">
                <p class="bg-danger p-5 persian text-right text-white mb-0">{{ $error }}</p>
            </div>
        </div>
    </div>
@endsection
