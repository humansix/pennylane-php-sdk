<?php

namespace Pennylane\Sdk\Api;

use Pennylane\Sdk\Client;
use Pennylane\Sdk\DTO\ListCustomers;
use Pennylane\Sdk\Exception\PennylaneSDKException;
use Pennylane\Sdk\ObjectSerializer;
use Pennylane\Sdk\Result\Paginated;
use Symfony\Component\Serializer\Exception\ExceptionInterface;

class CustomersApi implements ApiInterface
{
    private ObjectSerializer $serializer;

    public const ENDPOINT = '/customers';

    public function __construct(
        private readonly Client $client,
    ) {
        $this->serializer = $client->getSerializer();
    }

    public function list(array $params = []): ListCustomers
    {
        try {
            $response = $this->client->call('GET', self::ENDPOINT);

            if (!isset($response['customers'])) {
                throw new PennylaneSDKException('Error get customers: '.json_encode($response));
            }

            return $this->serializer->deserialize($response, ListCustomers::class, ['customer_list']);
        } catch (ExceptionInterface $e) {
            throw new PennylaneSDKException('Error communicating with API: '.$e->getMessage(), $e->getCode(), $e);
        }
    }

    /**
     * Get all customers.
     */
    public function getAll(): Paginated
    {
        try {
            return new Paginated($this, 'list');
        } catch (ExceptionInterface $e) {
            throw new PennylaneSDKException('Error communicating with API: '.$e->getMessage(), $e->getCode(), $e);
        }
    }
}
