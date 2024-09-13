<?php

namespace Pennylane\Sdk\Tests;

use Pennylane\Sdk\ObjectSerializer;
use Pennylane\Sdk\DTO\Customer;
use Pennylane\Sdk\DTO\ListInvoices;
use PHPUnit\Framework\TestCase;

class ObjectSerializerTest extends TestCase
{
    private ObjectSerializer $serializer;

    protected function setUp(): void
    {
        $this->serializer = new ObjectSerializer();
    }

    public function testSerialize()
    {
        $customer = new Customer();
        $customer->setSourceId('0e67fc3c-c632-4feb-ad34-e18ed5fbf66a');

        $json = $this->serializer->serialize($customer, ['invoice_create']);
        $expectedJson = '{"source_id":"0e67fc3c-c632-4feb-ad34-e18ed5fbf66a"}';

        $this->assertJsonStringEqualsJsonString($expectedJson, $json);
    }

    public function testDeserialize()
    {
        $json = '{"source_id":"0e67fc3c-c632-4feb-ad34-e18ed5fbf66a"}';

        $customer = $this->serializer->deserialize($json, Customer::class, ['invoice_create']);

        $this->assertInstanceOf(Customer::class, $customer);
        $this->assertEquals('0e67fc3c-c632-4feb-ad34-e18ed5fbf66a', $customer->getSourceId());
    }

    public function testDeserializeBigObject()
    {
        $json = '{
            "current_page": 1,
            "total_pages": 5,
            "total_invoices": 100,
            "invoices": [
                {
                    "amount": "100.00",
                    "currency_amount_before_tax": "80.00",
                    "currency_amount": "100.00",
                    "currency_tax": "20.00",
                    "currency": "USD",
                    "date": "2023-10-01",
                    "deadline": "2023-10-15",
                    "discount_type": "percentage",
                    "discount": "10",
                    "filename": "invoice_001.pdf",
                    "invoice_number": "INV-001",
                    "language": "en",
                    "paid": true,
                    "pdf_invoice_free_text": "Thank you for your business",
                    "pdf_invoice_subject": "Invoice for services",
                    "quote_group_uuid": "uuid-1234",
                    "remaining_amount": "0.00",
                    "special_mention": "none",
                    "status": "paid",
                    "updated_at": "2023-10-01T12:00:00Z",
                    "id": "1",
                    "label": "Service Invoice",
                    "is_draft": false,
                    "exchange_rate": 1.0,
                    "file_url": "http://example.com/invoice_001.pdf",
                    "public_url": "http://example.com/invoice_001_public.pdf",
                    "imputation_dates": [],
                    "source": "system",
                    "customer": {
                        "id": "cust-001",
                        "name": "John Doe"
                    },
                    "line_items_sections_attributes": [],
                    "line_items": [],
                    "matched_transactions": [],
                    "transactions_reference": "txn-001",
                    "categories": [],
                    "credit_notes": []
                }
            ]
        }';

        $listInvoices = $this->serializer->deserialize($json, ListInvoices::class, ['invoice_list']);
        $this->assertInstanceOf(ListInvoices::class, $listInvoices);
        $this->assertEquals(1, $listInvoices->getCurrentPage());
        $this->assertEquals(5, $listInvoices->getTotalPages());
        $this->assertEquals(100, $listInvoices->getTotalInvoices());
        $this->assertCount(1, $listInvoices->getInvoices());
        $this->assertEquals('INV-001', $listInvoices->getInvoices()[0]->getInvoiceNumber());
    }
}