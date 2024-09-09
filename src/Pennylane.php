<?php

namespace Pennylane\Sdk;

use Pennylane\Sdk\Api\Authentication;
use Pennylane\Sdk\Api\Users;
use Pennylane\Sdk\Api\Listings;
use Pennylane\Sdk\Api\CurrentUser;
use Pennylane\Sdk\Api\CustomerInvoiceApi;
use Pennylane\Sdk\Exception\PennylaneSDKException;
use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\RequestFactoryInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\StreamFactoryInterface;
use Psr\Http\Message\StreamInterface;

class Pennylane
{
    const VERSION = '1.0.0';

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

}
