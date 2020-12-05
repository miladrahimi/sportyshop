<?php

namespace App\Http\Controllers\Front\Account;

use App\Enums\OrderStateTypes;
use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderState;

class OrdersController extends Controller
{
    public function index()
    {
        $orders = Order::with('states')
            ->where('user_id', '=', auth()->id())
            ->orderByDesc('id')
            ->paginate(10);

        return view('front.account.orders.index', [
            'orders' => $orders,
        ]);
    }

    public function show(Order $order)
    {
        $state = OrderState::whereOrderId($order->id)->latest()->first();

        return view('front.account.orders.show', [
            'user' => auth()->user(),
            'order' => $order,
            'state' => $state ? $state->type : null,
        ]);
    }

    public function cancel(Order $order)
    {
        $state = $order->state();

        if ($state == null || $state->isCancellable()) {
            $newState = new OrderState();
            $newState->order_id = $order->id;
            $newState->type = OrderStateTypes::CANCELLED_BY_USER;
            $newState->information = json_encode([]);
            $newState->save();
        }

        return redirect()->route('account.orders.show', [$order]);
    }
}
