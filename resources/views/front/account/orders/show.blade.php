@extends('front._layout')

@section('title', 'سفارش')

@section('main')
    <div class="container persian text-right" id="app">
        <div class="row">
            <div class="col">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered">
                        <thead>
                        <tr>
                            <th>نام محصول</th>
                            <th>مشخصات</th>
                            <th>تعداد</th>
                            <th>قیمت محصول</th>
                            <th>قیمت مجموع</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($order->items as $item)
                            <tr>
                                <td>{{ $item->product->title }}</td>
                                <td>...</td>
                                <td>{{ $item->count }}</td>
                                <td>{{ $item->product_price }}</td>
                                <td>{{ $item->total_price }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                        <tfoot>
                        <tr class="bg-warning">
                            <th>جمع کل</th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th>{{ $order->price }}</th>
                        </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
        @if($state == null || $state == \App\Enums\OrderStateTypes::PAYING)
            <form method="post" action="{{ route('payment.gateway', ['bank' => 'idpay', 'order' => $order]) }}">
                <div class="row">
                    <div class="col-md-4 col-sm-6">
                        <div class="form-group">
                            <label>نام دریافت کننده:</label>
                            <input type="text" name="first_name" class="form-control" title=""
                                   value="{{ $user->first_name }}" required>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                        <div class="form-group">
                            <label>نام دریافت کننده:</label>
                            <input type="text" name="last_name" class="form-control" title=""
                                   value="{{ $user->last_name }}" required>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                        <div class="form-group">
                            <label>شماره همراه دریافت کننده:</label>
                            <input type="text" name="cellphone" class="form-control" title=""
                                   value="{{ $user->cellphone }}" required pattern="09[0-9]{9}">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4 col-sm-6">
                        <div class="form-group">
                            <label>استان:</label>
                            <input type="text" name="province" class="form-control" title=""
                                   value="{{ old('province') }}" required>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                        <div class="form-group">
                            <label>شهر:</label>
                            <input type="text" name="city" class="form-control" title=""
                                   value="{{ old('city') }}" required>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                        <div class="form-group">
                            <label>کد پستی:</label>
                            <input type="text" name="postal_code" class="form-control" title=""
                                   value="{{ old('postal_code') }}" required pattern="[0-9]{10}">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            <label>آدرس دقیق:</label>
                            <textarea class="form-control" name="details" title=""
                                      required>{{ old('details') }}</textarea>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            @csrf
                            <button type="submit" class="btn btn-success">تایید آدرس و ورود به درگاه بانک</button>
                        </div>
                    </div>
                </div>
            </form>
        @elseif($state == \App\Enums\OrderStateTypes::PAYED)
            <p class="bg-success text-light p-5">
                هزینه این سفارش با موفقیت پرداخت شده است و به زودی به دست شما خواهد رسید.
            </p>
        @elseif($state == \App\Enums\OrderStateTypes::SENDING)
            <p class="bg-success text-light p-5">
                این سفارش در حال ارسال است و به زودی به دست شما خواهد رسید.
            </p>
        @elseif($state == \App\Enums\OrderStateTypes::SENT)
            <p class="bg-primary text-light p-5">
                این سفارش به موفقیت تحویل شما داده شده است.
            </p>
        @elseif($state == \App\Enums\OrderStateTypes::FAILED_BY_GATEWAY)
            <p class="bg-danger text-light p-5">
                این سفارش با خطای بانکی مواجه شده است. در صورت تمایل به خرید می‌بایست سفارش جدیدی ثبت کنید.
            </p>
        @else
            <p class="bg-warning text-light p-5">
                وضعیت این سفارش نامشخص می‌باشد.
            </p>
        @endif
    </div>
@endsection
