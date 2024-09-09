<?php

namespace Pennylane\Sdk\DTO;

class Invoice
{
    private bool $draft;

    private Customer $customer;

    private ImputationDates $imputationDates;

    private \DateTime $date;

    private \DateTime $deadline;

    private string $externalId;

    private string $pdfInvoiceFreeText;

    private string $pdfInvoiceSubject;

    private string $currency;

    private string $specialMention;

    private float $discount;

    private string $language;

    private array $lineItemsSectionsAttributes;

    private array $lineItems;

    private array $categories;

    public function __construct(?array $data = null)
    {
        if ($data !== null) {
            $this->setDraft($data['draft'] ?? false);
            if ($data['customer'] instanceof Customer) {
                $this->setCustomer($data['customer']);
            } else {
                $this->setCustomer(new Customer($data['customer']) ?? null);
            }
            $this->setImputationDates($data['imputation_dates'] ?? new ImputationDates());
            $this->setDate(isset($data['date']) ? new \DateTime($data['date']) : null);
            $this->setDeadline(isset($data['deadline']) ? new \DateTime($data['deadline']) : null);
            $this->setExternalId($data['external_id'] ?? '');
            $this->setPdfInvoiceFreeText($data['pdf_invoice_free_text'] ?? '');
            $this->setPdfInvoiceSubject($data['pdf_invoice_subject'] ?? '');
            $this->setCurrency($data['currency'] ?? '');
            $this->setSpecialMention($data['special_mention'] ?? '');
            $this->setDiscount($data['discount'] ?? 0);
            $this->setLanguage($data['language'] ?? '');
            $this->setLineItemsSectionsAttributes($data['line_items_sections_attributes'] ?? []);
            $this->setLineItems($data['line_items'] ?? []);
            $this->setCategories($data['categories'] ?? []);
        }
    }

    public function getDraft(): bool
    {
        return $this->draft;
    }

    public function setDraft(bool $draft): void
    {
        $this->draft = $draft;
    }

    public function getCustomer(): Customer
    {
        return $this->customer;
    }

    public function setCustomer(Customer $customer): void
    {
        $this->customer = $customer;
    }

    public function getImputationDates(): ImputationDates
    {
        return $this->imputationDates;
    }

    public function setImputationDates(ImputationDates $imputationDates): void
    {
        $this->imputationDates = $imputationDates;
    }

    public function getDate(): \DateTime
    {
        return $this->date;
    }

    public function setDate(\DateTime $date): void
    {
        $this->date = $date;
    }

    public function getDeadline(): \DateTime
    {
        return $this->deadline;
    }

    public function setDeadline(\DateTime $deadline): void
    {
        $this->deadline = $deadline;
    }

    public function getExternalId(): string
    {
        return $this->externalId;
    }

    public function setExternalId(string $externalId): void
    {
        $this->externalId = $externalId;
    }

    public function getPdfInvoiceFreeText(): string
    {
        return $this->pdfInvoiceFreeText;
    }

    public function setPdfInvoiceFreeText(string $pdfInvoiceFreeText): void
    {
        $this->pdfInvoiceFreeText = $pdfInvoiceFreeText;
    }

    public function getPdfInvoiceSubject(): string
    {
        return $this->pdfInvoiceSubject;
    }

    public function setPdfInvoiceSubject(string $pdfInvoiceSubject): void
    {
        $this->pdfInvoiceSubject = $pdfInvoiceSubject;
    }

    public function getCurrency(): string
    {
        return $this->currency;
    }

    public function setCurrency(string $currency): void
    {
        $this->currency = $currency;
    }

    public function getSpecialMention(): string
    {
        return $this->specialMention;
    }

    public function setSpecialMention(string $specialMention): void
    {
        $this->specialMention = $specialMention;
    }

    public function getDiscount(): float
    {
        return $this->discount;
    }

    public function setDiscount(float $discount): void
    {
        $this->discount = $discount;
    }

    public function getLanguage(): string
    {
        return $this->language;
    }

    public function setLanguage(string $language): void
    {
        $this->language = $language;
    }

    public function getLineItemsSectionsAttributes(): array
    {
        return $this->lineItemsSectionsAttributes;
    }

    public function setLineItemsSectionsAttributes(array $lineItemsSectionsAttributes): void
    {
        $this->lineItemsSectionsAttributes = $lineItemsSectionsAttributes;
    }

    public function getLineItems(): array
    {
        return $this->lineItems;
    }

    public function setLineItems(array $lineItems): void
    {
        $this->lineItems = $lineItems;
    }

    public function getCategories(): array
    {
        return $this->categories;
    }

    public function setCategories(array $categories): void
    {
        $this->categories = $categories;
    }
}