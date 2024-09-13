<?php

namespace Pennylane\Sdk\Api;

use Pennylane\Sdk\Client;
use Pennylane\Sdk\DTO\CustomerInvoice;
use Pennylane\Sdk\DTO\Invoice;
use Pennylane\Sdk\DTO\ListInvoices;
use Pennylane\Sdk\Exception\PennylaneSDKException;
use Pennylane\Sdk\ObjectSerializer;
use Pennylane\Sdk\Result\Paginated;
use Symfony\Component\Serializer\Exception\ExceptionInterface;

class CustomerInvoiceApi implements ApiInterface
{
    private ObjectSerializer $serializer;

    public const ENDPOINT = '/customer_invoices';

    public function __construct(
        private readonly Client $client,
    ) {
        $this->serializer = $client->getSerializer();
    }

    /**
     * Create a new invoice.
     *
     * @return CustomerInvoice
     *
     * @throws PennylaneSDKException
     */
    public function create(CustomerInvoice $invoice): Invoice
    {
        try {
            $jsonBody = $this->serializer->serialize($invoice, ['invoice_create']);

            $response = $this->client->call('POST', self::ENDPOINT, $jsonBody);

            if (!isset($response['invoice']['id'])) {
                throw new PennylaneSDKException('Error creating invoice: '.json_encode($response));
            }

            return $this->serializer->deserialize($response['invoice'], Invoice::class, ['invoice_view']);
        } catch (\Exception $e) {
            throw new PennylaneSDKException('Error communicating with API: '.$e->getMessage(), $e->getCode(), $e);
        }
    }

    /**
     * Update an existing invoice.
     *
     * @return CustomerInvoice
     *
     * @throws PennylaneSDKException
     */
    public function update(string $invoiceId, CustomerInvoice $invoice): Invoice
    {
        try {
            $jsonBody = $this->serializer->serialize($invoice, ['invoice_update']);

            $response = $this->client->call('PUT', self::ENDPOINT.'/'.$invoiceId, $jsonBody, [
                'Content-Type' => 'application/json',
            ]);

            if (!isset($response['invoice']['id'])) {
                throw new PennylaneSDKException('Error updating invoice: '.json_encode($response));
            }

            return $this->serializer->deserialize($response['invoice'], Invoice::class, ['invoice_view']);
        } catch (ExceptionInterface $e) {
            throw new PennylaneSDKException('Error communicating with API: '.$e->getMessage(), $e->getCode(), $e);
        }
    }

    public function list(array $params = []): ListInvoices
    {
        try {
            $response = $this->client->call('GET', self::ENDPOINT);

            if (!isset($response['invoices'])) {
                throw new PennylaneSDKException('Error get invoices: '.json_encode($response));
            }

            return $this->serializer->deserialize($response, ListInvoices::class, ['invoice_list']);
        } catch (ExceptionInterface $e) {
            throw new PennylaneSDKException('Error communicating with API: '.$e->getMessage(), $e->getCode(), $e);
        }
    }

    /**
     * Get all invoices.
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
