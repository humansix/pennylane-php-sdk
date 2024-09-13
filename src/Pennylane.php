<?php

namespace Pennylane\Sdk;

use Pennylane\Sdk\Api\CustomersApi;
use Pennylane\Sdk\Api\CustomerInvoiceApi;
use Pennylane\Sdk\Exception\PennylaneSDKException;

class Pennylane
{
    public const VERSION = '1.0.1';

    protected $client;

    protected $token;

    public function __construct(string $token, $config = [])
    {
        if (empty($token)) {
            throw new PennylaneSDKException('An $token key is required to connecto to Pennylane API');
        }
        $this->client = new Client($token);
    }

    public function customerInvoice(): CustomerInvoiceApi
    {
        return new CustomerInvoiceApi($this->client, $this->token);
    }

    public function customer(): CustomersApi
    {
        return new CustomersApi($this->client, $this->token);
    }
}
