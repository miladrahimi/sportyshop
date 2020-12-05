@extends('front.account._layout')

@section('title', 'سفارش های من')

@section('form')
    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
            <tr>
                <th>کد سفارش</th>
                <th>قیمت</th>
                <th>تاریخ ثبت سفارش</th>
                <th>گزینه‌ها</th>
            </tr>
            </thead>
            <tbody>
            @foreach($orders as $order)
                <tr>
                    <td>{{ $order->id }}</td>
                    <td>{{ ($order->price / 10) . ' تومان' }}</td>
                    <td>
                        <pre>{{ jDate($order->created_at) }}</pre>
                    </td>
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
