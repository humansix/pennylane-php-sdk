<?php

namespace Pennylane\Sdk\Api;

use Symfony\Component\Serializer\Exception\ExceptionInterface;
use Pennylane\Sdk\DTO\CustomerInvoice;
use Pennylane\Sdk\Client;
use Pennylane\Sdk\DTO\ListInvoices;
use Pennylane\Sdk\Exception\PennylaneSDKException;
use Pennylane\Sdk\ObjectSerializer;
use Pennylane\Sdk\Result\Paginated;

class CustomerInvoiceApi implements ApiInterface
{
    private ObjectSerializer $serializer;

    public const RESULT_NODE = 'invoices';

    public function __construct(
        private readonly Client $client
    ) {
        $this->serializer = $client->getSerializer();
    }

    public function getResultNode(): string
    {
        return self::RESULT_NODE;
    }

    /**
     * Create a new invoice
     *
     * @param CustomerInvoice $invoice
     * @return CustomerInvoice
     * @throws PennylaneSDKException
     */
    public function create(CustomerInvoice $invoice): CustomerInvoice
    {
        try {
            $jsonBody = $this->serializer->serialize($invoice, 'json');

            $response = $this->client->call('POST', '/customer_invoices', $jsonBody);

            if (!isset($response['id'])) {
                throw new PennylaneSDKException('Error creating invoice: ' . json_encode($response));
            }

            return $this->serializer->deserialize($response, CustomerInvoice::class, 'json');

        } catch (\Exception $e) {
            throw new PennylaneSDKException('Error communicating with API: ' . $e->getMessage(), $e->getCode(), $e);
        }
    }

    /**
     * Update an existing invoice
     *
     * @param string $invoiceId
     * @param CustomerInvoice $invoice
     * @return CustomerInvoice
     * @throws PennylaneSDKException
     */
    public function update(string $invoiceId, CustomerInvoice $invoice): CustomerInvoice
    {
        try {
            $jsonBody = $this->serializer->serialize($invoice, 'json');
            $response = $this->client->call('PUT', '/customer_invoices', $jsonBody, [
                'Content-Type' => 'application/json',
            ]);

            if (!isset($response['id'])) {
                throw new PennylaneSDKException('Error updating invoice: ' . json_encode($response));
            }

            return $this->serializer->deserialize($response, CustomerInvoice::class, 'json');

        } catch (ExceptionInterface $e) {
            throw new PennylaneSDKException('Error communicating with API: ' . $e->getMessage(), $e->getCode(), $e);
        }
    }


    public function list(array $params = []): ListInvoices
    {
        try {
            $response = $this->client->call('GET', '/customer_invoices');

            if (!isset($response['invoices'])) {
                throw new PennylaneSDKException('Error get invoices: ' . json_encode($response));
            }

            return $this->serializer->deserialize($response, ListInvoices::class, 'json');

        } catch (ExceptionInterface $e) {
            throw new PennylaneSDKException('Error communicating with API: ' . $e->getMessage(), $e->getCode(), $e);
        }
    }

    /**
     * Get all invoices
     */
    public function getAll(): Paginated
    {
        try {

            return new Paginated($this, 'list');
        } catch (ExceptionInterface $e) {
            throw new PennylaneSDKException('Error communicating with API: ' . $e->getMessage(), $e->getCode(), $e);
        }
    }
}