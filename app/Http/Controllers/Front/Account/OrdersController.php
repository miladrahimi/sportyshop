<?php

namespace App\Http\Controllers\Front\Account;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderState;

class OrdersController extends Controller
{
    public function show(Order $order)
    {
        $state = OrderState::whereOrderId($order->id)->latest()->first();

        return view('front.account.orders.show', [
            'user' => auth()->user(),
            'order' => $order,
            'state' => $state ? $state->type : null,
        ]);
    }
}
