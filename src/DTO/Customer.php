<?php

namespace Pennylane\Sdk\DTO;

use Symfony\Component\Serializer\Annotation\Groups;

class Customer
{
    #[Groups(['customer_list', 'invoice_create', 'invoice_view'])]
    private string $sourceId;

    #[Groups(['customer_list'])]
    private string $name;

    #[Groups(['customer_list'])]
    private string $regNo;

    #[Groups(['customer_list'])]
    private string $vatNumber;

    #[Groups(['customer_list'])]
    private string $updatedAt;

    #[Groups(['customer_list'])]
    private array $emails;

    #[Groups(['customer_list'])]
    private ?string $billingIban;

    #[Groups(['customer_list'])]
    private string $customerType;

    #[Groups(['customer_list'])]
    private string $recipient;

    #[Groups(['customer_list'])]
    private Address $billingAddress;

    #[Groups(['customer_list'])]
    private Address $deliveryAddress;

    #[Groups(['customer_list'])]
    private string $paymentConditions;

    #[Groups(['customer_list'])]
    private string $phone;

    #[Groups(['customer_list'])]
    private string $reference;

    #[Groups(['customer_list'])]
    private ?string $notes;

    #[Groups(['customer_list'])]
    private PlanItem $planItem;

    public function __construct(?array $data = null)
    {
        if (null !== $data) {
            $this->setSourceId($data['source_id'] ?? null);
            $this->setName($data['name'] ?? null);
            $this->setRegNo($data['reg_no'] ?? null);
            $this->setVatNumber($data['vat_number'] ?? null);
            $this->setUpdatedAt($data['updated_at'] ?? null);
            $this->setEmails($data['emails'] ?? null);
            $this->setBillingIban($data['billing_iban'] ?? null);
            $this->setCustomerType($data['customer_type'] ?? null);
            $this->setRecipient($data['recipient'] ?? null);
            if ($data['billing_address'] instanceof Address) {
                $this->setBillingAddress($data['billing_address']);
            } else {
                $this->setBillingAddress(new Address($data['billing_address']) ?? null);
            }
            if ($data['delivery_address'] instanceof Address) {
                $this->setDeliveryAddress($data['delivery_address']);
            } else {
                $this->setDeliveryAddress(new Address($data['delivery_address']) ?? null);
            }
            $this->setPaymentConditions($data['payment_conditions'] ?? null);
            $this->setPhone($data['phone'] ?? null);
            $this->setReference($data['reference'] ?? null);
            $this->setNotes($data['notes'] ?? null);
            if ($data['plan_item'] instanceof PlanItem) {
                $this->setPlanItem($data['plan_item']);
            } else {
                $this->setPlanItem(new PlanItem($data['plan_item']) ?? null);
            }
        }
    }

    public function getSourceId(): string
    {
        return $this->sourceId;
    }

    public function setSourceId(string $sourceId): void
    {
        $this->sourceId = $sourceId;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getRegNo(): string
    {
        return $this->regNo;
    }

    public function setRegNo(string $regNo): void
    {
        $this->regNo = $regNo;
    }

    public function getVatNumber(): string
    {
        return $this->vatNumber;
    }

    public function setVatNumber(string $vatNumber): void
    {
        $this->vatNumber = $vatNumber;
    }

    public function getUpdatedAt(): string
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(string $updatedAt): void
    {
        $this->updatedAt = $updatedAt;
    }

    public function getEmails(): array
    {
        return $this->emails;
    }

    public function setEmails(array $emails): void
    {
        $this->emails = $emails;
    }

    public function getBillingIban(): string
    {
        return $this->billingIban;
    }

    public function setBillingIban(?string $billingIban): void
    {
        $this->billingIban = $billingIban;
    }

    public function getCustomerType(): string
    {
        return $this->customerType;
    }

    public function setCustomerType(string $customerType): void
    {
        $this->customerType = $customerType;
    }

    public function getRecipient(): string
    {
        return $this->recipient;
    }

    public function setRecipient(string $recipient): void
    {
        $this->recipient = $recipient;
    }

    public function getBillingAddress(): Address
    {
        return $this->billingAddress;
    }

    public function setBillingAddress(Address $billingAddress): void
    {
        $this->billingAddress = $billingAddress;
    }

    public function getDeliveryAddress(): Address
    {
        return $this->deliveryAddress;
    }

    public function setDeliveryAddress(Address $deliveryAddress): void
    {
        $this->deliveryAddress = $deliveryAddress;
    }

    public function getPaymentConditions(): string
    {
        return $this->paymentConditions;
    }

    public function setPaymentConditions(string $paymentConditions): void
    {
        $this->paymentConditions = $paymentConditions;
    }

    public function getPhone(): string
    {
        return $this->phone;
    }

    public function setPhone(string $phone): void
    {
        $this->phone = $phone;
    }

    public function getReference(): string
    {
        return $this->reference;
    }

    public function setReference(string $reference): void
    {
        $this->reference = $reference;
    }

    public function getNotes(): string
    {
        return $this->notes;
    }

    public function setNotes(?string $notes): void
    {
        $this->notes = $notes;
    }

    public function getPlanItem(): PlanItem
    {
        return $this->planItem;
    }

    public function setPlanItem(PlanItem $planItem): void
    {
        $this->planItem = $planItem;
    }
}
