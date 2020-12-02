<?php

namespace App\Http\Controllers\Front;

use App\Enums\OrderStateTypes;
use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderState;
use App\Models\Transaction;
use App\Services\Payment\Gateways\Idpay;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    /**
     * @param Order $order
     * @param Idpay $gateway
     * @throws GuzzleException
     */
    public function gateway(Order $order, Idpay $gateway)
    {
        $response = $gateway->createTransaction(
            $order->id,
            $order->price,
            $order->user->first_name,
            $order->user->last_name,
            $order->user->cellphone,
            'SportyShop.ir'
        );

        $state = new OrderState();
        $state->order_id = $order->id;
        $state->type = OrderStateTypes::PAYING;
        $state->information = json_encode(['unique_id' => $response['id']]);
        $state->save();

        return redirect($response['link']);
    }

    public function callback($bank, Request $request, Idpay $gateway)
    {
        if ($request->input('status') == 0) {
            dd('error.');
        }

        $orderId = $request->input('order_id');
        $lastState = OrderState::whereOrderId($orderId)
            ->latest()
            ->firstOrFail();

        if ($lastState->type != OrderStateTypes::PAYING) {
            dd('error.');
        }

        $transaction = new Transaction();
        $transaction->order_id = $orderId;
        $transaction->unique_id = $request->input('id');
        $transaction->track_id = $request->input('track_id');
        $transaction->price = $request->input('amount');
        $transaction->details = json_encode($request->input());
        $transaction->save();

        $state = new OrderState();
        $state->order_id = $orderId;
        $state->type = OrderStateTypes::PAYED;
        $state->information = json_encode(['transaction_id' => $transaction->id]);
        $state->save();

        return redirect()->route('account.orders.show', [$orderId]);
    }
}
