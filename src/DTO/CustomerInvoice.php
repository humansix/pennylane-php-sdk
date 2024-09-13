<?php

namespace Pennylane\Sdk\DTO;

use Symfony\Component\Serializer\Annotation\Groups;

class CustomerInvoice
{
    #[Groups(['invoice_create'])]
    private bool $createCustomer;

    #[Groups(['invoice_create'])]
    private bool $createProducts;

    #[Groups(['invoice_create', 'invoice_update'])]
    private Invoice $invoice;

    #[Groups(['invoice_create'])]
    private bool $updateCustomer;

    public function __construct(?array $data = null)
    {
        if (null !== $data) {
            $this->setCreateCustomer($data['create_customer'] ?? false);
            $this->setCreateProducts($data['create_products'] ?? false);
            $this->setInvoice($data['invoice'] ?? new Invoice());
            $this->setUpdateCustomer($data['update_customer'] ?? false);
        }
    }

    public function getCreateCustomer(): bool
    {
        return $this->createCustomer;
    }

    public function setCreateCustomer(bool $createCustomer): void
    {
        $this->createCustomer = $createCustomer;
    }

    public function getCreateProducts(): bool
    {
        return $this->createProducts;
    }

    public function setCreateProducts(bool $createProducts): void
    {
        $this->createProducts = $createProducts;
    }

    public function getInvoice(): Invoice
    {
        return $this->invoice;
    }

    public function setInvoice(Invoice $invoice): void
    {
        $this->invoice = $invoice;
    }

    public function getUpdateCustomer(): bool
    {
        return $this->updateCustomer;
    }

    public function setUpdateCustomer(bool $updateCustomer): void
    {
        $this->updateCustomer = $updateCustomer;
    }
}
