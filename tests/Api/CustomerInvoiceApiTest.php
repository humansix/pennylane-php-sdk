<?php

use PHPUnit\Framework\TestCase;
use Pennylane\Sdk\Api\CustomerInvoiceApi;
use Pennylane\Sdk\Client;
use Pennylane\Sdk\DTO\CustomerInvoice;
use Pennylane\Sdk\DTO\Customer;
use Pennylane\Sdk\DTO\ImputationDates;
use Pennylane\Sdk\DTO\Invoice;
use Pennylane\Sdk\DTO\LineItemsSectionAttributes;
use Pennylane\Sdk\DTO\LineItem;
use Pennylane\Sdk\DTO\Category;
use Pennylane\Sdk\Exception\PennylaneSDKException;
use Symfony\Component\Serializer\SerializerInterface;

class CustomerInvoiceApiTest extends TestCase
{
    private $api;
    private $client;
    private $serializer;

    protected function setUp(): void
    {
        $this->client = $this->createMock(Client::class);
        $this->serializer = $this->createMock(SerializerInterface::class);
        $this->api = new CustomerInvoiceApi($this->client, $this->serializer);
    }

    public function testCreateInvoice(): void
    {
        $customer = new Customer(['source_id' => '0e67fc3c-c632-4feb-ad34-e18ed5fbf66a']);
        $imputationDates = new ImputationDates(['start_date' => '2020-06-30', 'end_date' => '2021-06-30']);
        $lineItemsSectionAttributes = [
            new LineItemsSectionAttributes(['title' => 'Line items section title', 'description' => 'Description of the line items section', 'rank' => 1]),
            new LineItemsSectionAttributes(['title' => 'Line items section title', 'description' => 'Description of the line items section', 'rank' => 1])
        ];
        $lineItems = [
            new LineItem(['label' => 'Demo label', 'quantity' => 12, 'discount' => 25, 'section_rank' => 1, 'plan_item_number' => '707'])
        ];
        $categories = [
            new Category(['source_id' => '38a1f19a-256d-4692-a8fe-0a16403f59ff', 'weight' => 0.8, 'amount' => 180])
        ];
        $invoice = new Invoice([
            'draft' => true,
            'customer' => $customer,
            'imputation_dates' => $imputationDates,
            'date' => '2023-08-30',
            'deadline' => '2023-08-30',
            'external_id' => 'ACVPXQH16V',
            'pdf_invoice_free_text' => 'Additional free field',
            'pdf_invoice_subject' => 'Invoice title',
            'currency' => 'EUR',
            'special_mention' => 'Additional details',
            'discount' => 25,
            'language' => 'fr_FR',
            'line_items_sections_attributes' => $lineItemsSectionAttributes,
            'line_items' => $lineItems,
            'categories' => $categories
        ]);
        $invoiceCreate = new CustomerInvoice([
            'create_customer' => true,
            'create_products' => true,
            'invoice' => $invoice,
            'update_customer' => true
        ]);

        $serializedInvoiceCreate = json_encode($invoiceCreate);

        $this->serializer
            ->expects($this->once())
            ->method('serialize')
            ->with($invoiceCreate, 'json')
            ->willReturn($serializedInvoiceCreate);

        $this->client
            ->expects($this->once())
            ->method('call')
            ->willReturn(['id' => '123']);

        $this->serializer
            ->expects($this->once())
            ->method('deserialize')
            ->with(json_encode(['id' => '123']), CustomerInvoice::class, 'json')
            ->willReturn($invoiceCreate);

        $result = $this->api->create($invoiceCreate);

        $this->assertEquals($invoiceCreate, $result);
    }

    public function testUpdateInvoice(): void
    {
        $invoice = new CustomerInvoice([
            'id' => '123',
            'status' => 'updated'
        ]);

        $this->serializer
            ->expects($this->once())
            ->method('serialize')
            ->with($invoice, 'json')
            ->willReturn(json_encode($invoice));

        $this->client
            ->expects($this->once())
            ->method('call')
            ->willReturn(['id' => '123']);

        $this->serializer
            ->expects($this->once())
            ->method('deserialize')
            ->with(json_encode(['id' => '123']), CustomerInvoice::class, 'json')
            ->willReturn($invoice);

        $result = $this->api->update('123', $invoice);

        $this->assertEquals($invoice, $result);
    }

    public function testCreateInvoiceThrowsException(): void
    {
        $customer = new Customer(['source_id' => '0e67fc3c-c632-4feb-ad34-e18ed5fbf66a']);
        $imputationDates = new ImputationDates([
            'start_date' => new \DateTime('2020-06-30'),
            'end_date' => new \DateTime('2021-06-30')
        ]);
        $lineItemsSectionAttributes = [
            new LineItemsSectionAttributes(['title' => 'Line items section title', 'description' => 'Description of the line items section', 'rank' => 1]),
            new LineItemsSectionAttributes(['title' => 'Line items section title', 'description' => 'Description of the line items section', 'rank' => 1])
        ];
        $lineItems = [
            new LineItem(['label' => 'Demo label', 'quantity' => 12, 'discount' => 25, 'section_rank' => 1, 'plan_item_number' => '707'])
        ];
        $categories = [
            new Category(['source_id' => '38a1f19a-256d-4692-a8fe-0a16403f59ff', 'weight' => 0.8, 'amount' => 180])
        ];
        $invoice = new Invoice([
            'draft' => true,
            'customer' => $customer,
            'imputation_dates' => $imputationDates,
            'date' => '2023-08-30',
            'deadline' => '2023-08-30',
            'external_id' => 'ACVPXQH16V',
            'pdf_invoice_free_text' => 'Additional free field',
            'pdf_invoice_subject' => 'Invoice title',
            'currency' => 'EUR',
            'special_mention' => 'Additional details',
            'discount' => 25,
            'language' => 'fr_FR',
            'line_items_sections_attributes' => $lineItemsSectionAttributes,
            'line_items' => $lineItems,
            'categories' => $categories
        ]);
        $invoiceCreate = new CustomerInvoice([
            'create_customer' => true,
            'create_products' => true,
            'invoice' => $invoice,
            'update_customer' => true
        ]);

        $serializedInvoiceCreate = json_encode($invoiceCreate);

        $this->serializer
            ->expects($this->once())
            ->method('serialize')
            ->with($invoiceCreate, 'json')
            ->willReturn($serializedInvoiceCreate);

        $this->client
            ->expects($this->once())
            ->method('call')
            ->will($this->throwException(new PennylaneSDKException('Error creating invoice')));

        $this->expectException(PennylaneSDKException::class);
        $this->expectExceptionMessage('Error creating invoice');

        $this->api->create($invoiceCreate);
    }

    public function testUpdateInvoiceThrowsException(): void
    {
        $invoice = new CustomerInvoice([
            'id' => '123',
            'status' => 'updated'
        ]);

        $this->serializer
            ->expects($this->once())
            ->method('serialize')
            ->with($invoice, 'json')
            ->willReturn(json_encode($invoice));

        $this->client
            ->expects($this->once())
            ->method('call')
            ->will($this->throwException(new PennylaneSDKException('Error updating invoice')));

        $this->expectException(PennylaneSDKException::class);
        $this->expectExceptionMessage('Error updating invoice');

        $this->api->update('123', $invoice);
    }
}