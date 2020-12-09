@extends('front.account._layout')

@section('title', 'سفارش های من')

@section('form')
    <div class="table-responsive">
        <table class="table table-sm table-striped table-bordered">
            <thead>
            <tr>
                <th>کد</th>
                <th>قیمت (تومان)</th>
                <th>تاریخ ثبت سفارش</th>
                <th>گزینه‌ها</th>
            </tr>
            </thead>
            <tbody>
            @foreach($orders as $order)
                <tr>
                    <td>{{ $order->id }}</td>
                    <td>{{ number_format($order->price / 10) }}</td>
                    <td>{{ jDate($order->created_at) }}</td>
                    <td>
                        <a href="{{ route('account.orders.show', $order->id) }}"
                           class="btn btn-primary btn-sm btn-block">نمایش</a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection

@section('scripts')
    <script>
        $('#nav_orders').addClass('active');
    </script>
@endsection
