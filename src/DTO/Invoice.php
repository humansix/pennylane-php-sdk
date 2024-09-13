<?php

namespace Pennylane\Sdk\DTO;

use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Serializer\Attribute\Context;
use Symfony\Component\Serializer\Normalizer\DateTimeNormalizer;

class Invoice
{
    #[Groups(['invoice_view', 'invoice_list'])]
    private string $id;

    #[Groups(['invoice_create'])]
    private bool $draft;

    #[Groups(['invoice_create', 'invoice_view'])]
    private Customer $customer;

    #[Groups(['invoice_create', 'invoice_view'])]
    private ImputationDates $imputationDates;

    #[Groups(['invoice_create', 'invoice_view'])]
    #[Context([DateTimeNormalizer::FORMAT_KEY => 'Y-m-d'])]
    private \DateTimeInterface $date;

    #[Groups(['invoice_create', 'invoice_view'])]
    #[Context([DateTimeNormalizer::FORMAT_KEY => 'Y-m-d'])]
    private \DateTimeInterface $deadline;

    #[Groups(['invoice_create', 'invoice_view'])]
    private string $externalId;

    #[Groups(['invoice_create', 'invoice_view'])]
    private string $pdfInvoiceFreeText;

    #[Groups(['invoice_create', 'invoice_view'])]
    private string $pdfInvoiceSubject;

    #[Groups(['invoice_create', 'invoice_view'])]
    private string $currency;

    #[Groups(['invoice_view'])]
    private string $amount;

    #[Groups(['invoice_view'])]
    private string $currencyAmountBeforeTax;

    #[Groups(['invoice_view'])]
    private string $currencyAmount;

    #[Groups(['invoice_view'])]
    private string $currencyTax;

    #[Groups(['invoice_create', 'invoice_view'])]
    private string $specialMention;

    #[Groups(['invoice_view'])]
    private string $discountType;

    #[Groups(['invoice_create', 'invoice_view'])]
    private string $discount;

    #[Groups(['invoice_view'])]
    private ?string $filename = null;

    #[Groups(['invoice_view'])]
    private string $invoiceNumber;

    #[Groups(['invoice_create', 'invoice_view'])]
    private string $language;

    #[Groups(['invoice_view'])]
    private bool $paid;

    #[Groups(['invoice_view'])]
    private string $quoteGroupUuid;

    #[Groups(['invoice_view'])]
    private string $remainingAmount;

    #[Groups(['invoice_view'])]
    private string $status;

    #[Groups(['invoice_view'])]
    #[Context([DateTimeNormalizer::FORMAT_KEY => 'Y-m-d\TH:i:s.u\Z'])]
    private string $updatedAt;

    #[Groups(['invoice_view'])]
    private bool $customer_validation_needed;

    #[Groups(['invoice_view'])]
    private string $label;

    #[Groups(['invoice_view'])]
    private float $exchangeRate;

    #[Groups(['invoice_view'])]
    private string $fileUrl;

    #[Groups(['invoice_view'])]
    private string $publicUrl;

    #[Groups(['invoice_create', 'invoice_view'])]
    private array $lineItemsSectionsAttributes;

    #[Groups(['invoice_create', 'invoice_view', 'invoice_update', 'invoice_list'])]
    private array $lineItems;

    #[Groups(['invoice_create', 'invoice_view'])]
    private array $categories;

    public function __construct(?array $data = null)
    {
        if (null !== $data) {
            $this->setId($data['id'] ?? '');
            $this->setDraft($data['draft'] ?? false);
            if ($data['customer'] instanceof Customer) {
                $this->setCustomer($data['customer']);
            } else {
                $this->setCustomer(new Customer($data['customer']) ?? null);
            }
            if ($data['imputation_dates'] instanceof ImputationDates) {
                $this->setImputationDates($data['imputation_dates']);
            } else {
                $this->setImputationDates(new ImputationDates($data['imputation_dates']) ?? null);
            }
            if ($data['date'] instanceof \DateTime) {
                $this->setDate($data['date']);
            } else {
                $this->setDate(new \DateTime($data['date']) ?? null);
            }
            if ($data['deadline'] instanceof \DateTime) {
                $this->setDeadline($data['deadline']);
            } else {
                $this->setDeadline(new \DateTime($data['deadline']) ?? null);
            }
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
            $this->setAmount($data['amount'] ?? '');
            $this->setCurrencyAmountBeforeTax($data['currency_amount_before_tax'] ?? '');
            $this->setCurrencyAmount($data['currency_amount'] ?? '');
            $this->setCurrencyTax($data['currency_tax'] ?? '');
            $this->setDiscountType($data['discount_type'] ?? '');
            $this->setFilename($data['filename'] ?? null);
            $this->setInvoiceNumber($data['invoice_number'] ?? '');
            $this->setPaid($data['paid'] ?? false);
            $this->setQuoteGroupUuid($data['quote_group_uuid'] ?? '');
            $this->setRemainingAmount($data['remaining_amount'] ?? '');
            $this->setStatus($data['status'] ?? '');
            $this->setUpdatedAt($data['updated_at'] ?? '');
            $this->setCustomerValidationNeeded($data['customer_validation_needed'] ?? false);
            $this->setLabel($data['label'] ?? '');
            $this->setExchangeRate($data['exchange_rate'] ?? 0.0);
            $this->setFileUrl($data['file_url'] ?? '');
            $this->setPublicUrl($data['public_url'] ?? '');
        }
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function setId(string $id): self
    {
        $this->id = $id;

        return $this;
    }

    public function getAmount(): float
    {
        return $this->amount;
    }

    public function setAmount(string $amount): self
    {
        $this->amount = $amount;

        return $this;
    }

    public function getCurrencyAmountBeforeTax(): string
    {
        return $this->currencyAmountBeforeTax;
    }

    public function setCurrencyAmountBeforeTax(string $currencyAmountBeforeTax): self
    {
        $this->currencyAmountBeforeTax = $currencyAmountBeforeTax;

        return $this;
    }

    public function getCurrencyAmount(): string
    {
        return $this->currencyAmount;
    }

    public function setCurrencyAmount(string $currencyAmount): self
    {
        $this->currencyAmount = $currencyAmount;

        return $this;
    }

    public function getCurrencyTax(): string
    {
        return $this->currencyTax;
    }

    public function setCurrencyTax(string $currencyTax): self
    {
        $this->currencyTax = $currencyTax;

        return $this;
    }

    public function getDiscountType(): string
    {
        return $this->discountType;
    }

    public function setDiscountType(string $discountType): self
    {
        $this->discountType = $discountType;

        return $this;
    }

    public function getFilename(): string
    {
        return $this->filename;
    }

    public function setFilename(?string $filename): self
    {
        $this->filename = $filename;

        return $this;
    }

    public function getInvoiceNumber(): string
    {
        return $this->invoiceNumber;
    }

    public function setInvoiceNumber(string $invoiceNumber): self
    {
        $this->invoiceNumber = $invoiceNumber;

        return $this;
    }

    public function getPaid(): bool
    {
        return $this->paid;
    }

    public function setPaid(bool $paid): self
    {
        $this->paid = $paid;

        return $this;
    }

    public function getQuoteGroupUuid(): string
    {
        return $this->quoteGroupUuid;
    }

    public function setQuoteGroupUuid(string $quoteGroupUuid): self
    {
        $this->quoteGroupUuid = $quoteGroupUuid;

        return $this;
    }

    public function getRemainingAmount(): string
    {
        return $this->remainingAmount;
    }

    public function setRemainingAmount(string $remainingAmount): self
    {
        $this->remainingAmount = $remainingAmount;

        return $this;
    }

    public function getStatus(): string
    {
        return $this->status;
    }

    public function setStatus(string $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function getUpdatedAt(): string
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(string $updatedAt): self
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    public function isCustomerValidationNeeded(): bool
    {
        return $this->customer_validation_needed;
    }

    public function setCustomerValidationNeeded(bool $customerValidationNeeded): self
    {
        $this->customer_validation_needed = $customerValidationNeeded;

        return $this;
    }

    public function getLabel(): string
    {
        return $this->label;
    }

    public function setLabel(string $label): self
    {
        $this->label = $label;

        return $this;
    }

    public function isDraft(): bool
    {
        return $this->draft;
    }

    public function setDraft(bool $draft): self
    {
        $this->draft = $draft;

        return $this;
    }

    public function getExchangeRate(): float
    {
        return $this->exchangeRate;
    }

    public function setExchangeRate(float $exchangeRate): self
    {
        $this->exchangeRate = $exchangeRate;

        return $this;
    }

    public function getFileUrl(): string
    {
        return $this->fileUrl;
    }

    public function setFileUrl(string $fileUrl): self
    {
        $this->fileUrl = $fileUrl;

        return $this;
    }

    public function getPublicUrl(): string
    {
        return $this->publicUrl;
    }

    public function setPublicUrl(string $publicUrl): self
    {
        $this->publicUrl = $publicUrl;

        return $this;
    }

    public function getCustomer(): Customer
    {
        return $this->customer;
    }

    public function setCustomer(Customer $customer): self
    {
        $this->customer = $customer;

        return $this;
    }

    public function getImputationDates(): ImputationDates
    {
        return $this->imputationDates;
    }

    public function setImputationDates(ImputationDates $imputationDates): self
    {
        $this->imputationDates = $imputationDates;

        return $this;
    }

    public function getDate(): \DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getDeadline(): \DateTimeInterface
    {
        return $this->deadline;
    }

    public function setDeadline(\DateTimeInterface $deadline): self
    {
        $this->deadline = $deadline;

        return $this;
    }

    public function getExternalId(): string
    {
        return $this->externalId;
    }

    public function setExternalId(string $externalId): self
    {
        $this->externalId = $externalId;

        return $this;
    }

    public function getPdfInvoiceFreeText(): string
    {
        return $this->pdfInvoiceFreeText;
    }

    public function setPdfInvoiceFreeText(string $pdfInvoiceFreeText): self
    {
        $this->pdfInvoiceFreeText = $pdfInvoiceFreeText;

        return $this;
    }

    public function getPdfInvoiceSubject(): string
    {
        return $this->pdfInvoiceSubject;
    }

    public function setPdfInvoiceSubject(string $pdfInvoiceSubject): self
    {
        $this->pdfInvoiceSubject = $pdfInvoiceSubject;

        return $this;
    }

    public function getCurrency(): string
    {
        return $this->currency;
    }

    public function setCurrency(string $currency): self
    {
        $this->currency = $currency;

        return $this;
    }

    public function getSpecialMention(): string
    {
        return $this->specialMention;
    }

    public function setSpecialMention(string $specialMention): self
    {
        $this->specialMention = $specialMention;

        return $this;
    }

    public function getDiscount(): string
    {
        return $this->discount;
    }

    public function setDiscount(string $discount): self
    {
        $this->discount = $discount;

        return $this;
    }

    public function getLanguage(): string
    {
        return $this->language;
    }

    public function setLanguage(string $language): self
    {
        $this->language = $language;

        return $this;
    }

    public function getLineItemsSectionsAttributes(): array
    {
        return $this->lineItemsSectionsAttributes;
    }

    public function setLineItemsSectionsAttributes(array $lineItemsSectionsAttributes): self
    {
        $this->lineItemsSectionsAttributes = $lineItemsSectionsAttributes;

        return $this;
    }

    public function getLineItems(): array
    {
        return $this->lineItems;
    }

    public function setLineItems(array $lineItems): self
    {
        $this->lineItems = $lineItems;

        return $this;
    }

    public function getCategories(): array
    {
        return $this->categories;
    }

    public function setCategories(array $categories): self
    {
        $this->categories = $categories;

        return $this;
    }
}
