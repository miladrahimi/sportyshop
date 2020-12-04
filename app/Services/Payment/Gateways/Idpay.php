<?php

namespace App\Services\Payment\Gateways;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\RequestOptions;

class Idpay
{
    /**
     * @var Client
     */
    private $http;

    /**
     * @var string
     */
    private $callback;

    public function __construct()
    {
        $this->callback = route('payment.callback', ['bank' => 'idpay']);
        $this->http = new Client([
            'base_uri' => config('payment.gateways.idpay.url'),
            'timeout' => config('payment.gateways.idpay.timeout'),
            'headers' => [
                'X-API-KEY' => config('payment.gateways.idpay.key'),
                'X-SANDBOX' => config('payment.gateways.idpay.sandbox'),
            ],
        ]);
    }

    /**
     * @param int $orderId
     * @param int $price
     * @param string $firstName
     * @param string $lastName
     * @param string $cellphone
     * @param string $description
     * @return array
     * @throws GuzzleException
     */
    public function createTransaction(
        int $orderId,
        int $price,
        string $firstName,
        string $lastName,
        string $cellphone,
        string $description
    ): array
    {
        $response = $this->http->post('/v1.1/payment', [
            RequestOptions::JSON => [
                'order_id' => "$orderId",
                'amount' => $price,
                'name' => "$firstName $lastName",
                'phone' => $cellphone,
                'desc' => $description,
                'callback' => $this->callback,
            ],
        ]);

        return json_decode($response->getBody()->getContents(), true);
    }

    /**
     * @param string $uniqueId
     * @param int $orderId
     * @return mixed
     * @throws GuzzleException
     */
    public function inquiry(string $uniqueId, int $orderId)
    {
        $response = $this->http->post('/v1.1/payment/inquiry', [
            RequestOptions::JSON => [
                'id' => $uniqueId,
                'order_id' => "$orderId",
            ],
        ]);

        return json_decode($response->getBody()->getContents(), true);
    }

    /**
     * @param string $uniqueId
     * @param int $orderId
     * @return mixed
     * @throws GuzzleException
     */
    public function verify(string $uniqueId, int $orderId)
    {
        $response = $this->http->post('/v1.1/payment/verify', [
            RequestOptions::JSON => [
                'id' => $uniqueId,
                'order_id' => "$orderId",
            ],
        ]);

        return json_decode($response->getBody()->getContents(), true);
    }
}
