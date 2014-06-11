<?php

namespace Omnipay\GoCoin\Message;

use Omnipay\GoCoin\Message\Response;
use Omnipay\Common\Message\ResponseInterface;

/**
 * GoCoin Purchase Response
 */
class PurchaseResponse extends Response implements ResponseInterface
{
    public function getData()
    {
        return parent::getData() -> json();
    }

    public function isSuccessful()
    {
        return parent::getData() -> getStatusCode() == 201;
    }

    public function getTransactionReference()
    {
        $json = $this -> getData();
        if (isset($json['id'])) {
            return $json['id'];
        }
    }
}
