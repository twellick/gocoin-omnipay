<?php

namespace Omnipay\GoCoin\Message;

use Omnipay\Tests\TestCase;

class PurchaseRequestTest extends TestCase
{
    const TEST_MODE     = FALSE;
    const TOKEN         = 'TOKEN';

    public function setUp()
    {
        $this -> request = new PurchaseRequest($this -> getHttpClient(), $this -> getHttpRequest());
        $this -> request -> initialize(
            array(
                'testMode' => PurchaseRequestTest::TEST_MODE,
                'token' => PurchaseRequestTest::TOKEN,
                'amount' => '1.00',
                'currency' => 'USD',
                'itemName' => 'Another Item',
                'itemSku' => '123456',
            )
        );
    }

    public function testGetData()
    {
        $this -> request -> initialize(
            array(
                'testMode' => PurchaseRequestTest::TEST_MODE,
                'token' => PurchaseRequestTest::TOKEN,
                'amount' => '1.00',
                'currency' => 'USD',
                'itemName' => 'Another Item',
                'itemSku' => '123456',
            )
        );

        $data = $this -> request -> getData();
        $this -> assertSame('abc123', $data['account_id']);
        $this -> assertSame('0.00100000', $data['button']['price_string']);
        $this -> assertSame('BTC', $data['button']['price_currency_iso']);
        $this -> assertSame('Socks', $data['button']['name']);
        $this -> assertSame('https://example.com/return', $data['button']['success_url']);
        $this -> assertSame('https://example.com/cancel', $data['button']['cancel_url']);
        $this -> assertSame('https://example.com/notify', $data['button']['callback_url']);
    }

    public function testGetDataAccountIdNull()
    {
        // empty string must be converted to null
        $this -> request -> setAccountId('');

        $data = $this -> request -> getData();
        $this -> assertNull($data['account_id']);

    }

    public function testSendSuccess()
    {
        $this -> setMockHttpResponse('PurchaseSuccess.txt');
        $response = $this -> request -> send();

        $this -> assertFalse($response -> isSuccessful());
        $this -> assertFalse($response -> isRedirect());
        $this -> assertNull($response -> getMessage());
        $this -> assertSame('GET', $response -> getRedirectMethod());
        $this -> assertNull($response -> getRedirectData());
        $this -> assertSame('30dae91b81299066ba126e3858f89fd8', $response -> getTransactionReference());
    }

    public function testSendFailure()
    {
        $this -> setMockHttpResponse('PurchaseFailure.txt');
        $response = $this -> request -> send();

        $this -> assertFalse($response -> isSuccessful());
        $this -> assertFalse($response -> isRedirect());
        $this -> assertSame("Name can't be blank", $response -> getMessage());
        $this -> assertNull($response -> getRedirectUrl());
        $this -> assertNull($response -> getRedirectData());
        $this -> assertSame('c777f2ca6e01b8c116b267a053603e62', $response -> getTransactionReference());
    }

    public function testSendUnauthorized()
    {
        $this -> setMockHttpResponse('PurchaseUnauthorized.txt');
        $response = $this -> request -> send();

        $this -> assertFalse($response -> isSuccessful());
        $this -> assertFalse($response -> isRedirect());
        $this -> assertSame('ACCESS_SIGNATURE does not validate', $response -> getMessage());
        $this -> assertNull($response -> getRedirectUrl());
        $this -> assertNull($response -> getRedirectData());
        $this -> assertNull($response -> getTransactionReference());
    }
}
