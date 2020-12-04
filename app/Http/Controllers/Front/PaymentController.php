<?php

namespace App\Http\Controllers\Front;

use App\Enums\OrderStateTypes;
use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderAddress;
use App\Models\OrderState;
use App\Models\Transaction;
use App\Services\Payment\Gateways\Idpay;
use DB;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;
use Throwable;

class PaymentController extends Controller
{
    /**
     * @var Request
     */
    private $request;

    /**
     * @var Idpay
     */
    private $idpay;

    /**
     * PaymentController constructor.
     *
     * @param Request $request
     * @param Idpay $idpay
     */
    public function __construct(Request $request, Idpay $idpay)
    {
        $this->request = $request;
        $this->idpay = $idpay;
    }

    /**
     * @param $bank
     * @param Order $order
     * @return Application|RedirectResponse|Redirector
     * @throws GuzzleException
     */
    public function gateway($bank, Order $order)
    {
        $this->request->validate([
            'first_name' => ['required'],
            'last_name' => ['required'],
            'cellphone' => ['required', 'cellphone'],
            'city' => ['required'],
            'province' => ['required'],
            'postal_code' => ['required', 'regex:/^[0-9]{10}$/'],
            'details' => ['required'],
        ]);

        $address = new OrderAddress();
        $address->order_id = $order->id;
        $address->first_name = $this->request->input('first_name');
        $address->last_name = $this->request->input('last_name');
        $address->cellphone = $this->request->input('cellphone');
        $address->city = $this->request->input('city');
        $address->province = $this->request->input('province');
        $address->code = $this->request->input('code');
        $address->details = $this->request->input('details');
        $address->save();

        switch ($bank) {
            case 'idpay':
                return $this->gatewayIdpay($order);
            default:
                abort(403);
                return null;
        }
    }

    /**
     * @param Order $order
     * @return Application|RedirectResponse|Redirector
     * @throws GuzzleException
     */
    private function gatewayIdpay(Order $order)
    {
        $response = $this->idpay->createTransaction(
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
        $state->information = json_encode($response);
        $state->save();

        return redirect($response['link']);
    }

    /**
     * @param $bank
     * @return RedirectResponse|null
     * @throws GuzzleException
     * @throws Throwable
     */
    public function callback($bank)
    {
        switch ($bank) {
            case 'idpay':
                return $this->callbackIdpay();
            default:
                abort(403);
                return null;
        }
    }

    /**
     * @return RedirectResponse|Response
     * @throws GuzzleException
     * @throws Throwable
     */
    private function callbackIdpay()
    {
        $order = Order::findOrFail($this->request->input('order_id'));

        $lastState = OrderState::whereOrderId($order->id)->latest()->firstOrFail();

        if ($lastState->type != OrderStateTypes::PAYING) {
            return response()->view('front.payment.callback.error', [
                'error' => trans('e.callback-already-stated'),
            ], 400);
        }

        $status = $this->request->input('status');
        if ($status != 100) {
            return $this->error(
                $order->id,
                trans('e.idpay.template', ['error' => trans("e.idpay.$status")])
            );
        }

        $inquiry = $this->idpay->inquiry($this->request->input('id'), $order->id);

        if ($inquiry['status'] != 100) {
            return $this->error(
                $order->id,
                trans('e.idpay.template', ['error' => trans("e.idpay.{$inquiry['status']}")]),
                $inquiry
            );
        }

        $transaction = new Transaction();
        $transaction->order_id = $order->id;
        $transaction->unique_id = $this->request->input('id');
        $transaction->track_id = $this->request->input('track_id');
        $transaction->price = $this->request->input('amount');
        $transaction->details = json_encode($this->request->input());

        $state = new OrderState();
        $state->order_id = $order->id;
        $state->type = OrderStateTypes::PAYED;
        $state->information = json_encode(['inquiry' => $inquiry]);

        DB::transaction(function() use ($transaction, $state, $order) {
            $transaction->save();
            $state->save();
            $this->idpay->verify($this->request->input('id'), $order->id);
        });

        return redirect()->route('account.orders.show', [$order->id]);
    }

    private function error(int $orderId, string $error, array $info = [])
    {
        $state = new OrderState();
        $state->order_id = $orderId;
        $state->type = OrderStateTypes::FAILED_BY_GATEWAY;
        $state->information = json_encode(['request' => $this->request->input(), 'info' => $info]);
        $state->save();

        return response()->view('front.payment.callback.error', [
            'error' => $error,
        ], 400);
    }
}
