<?php

namespace Pennylane\Sdk\DTO;

use Symfony\Component\Serializer\Annotation\Groups;

class LineItem
{
    #[Groups(['invoice_create', 'invoice_view', 'invoice_update'])]
    private ?string $label = null;

    #[Groups(['invoice_create', 'invoice_view', 'invoice_update'])]
    private ?int $quantity = null;

    #[Groups(['invoice_create', 'invoice_view'])]
    private ?float $discount = null;

    #[Groups(['invoice_create', 'invoice_view', 'invoice_update'])]
    private ?int $sectionRank = null;

    #[Groups(['invoice_create', 'invoice_view', 'invoice_update'])]
    private ?string $planItemNumber = null;

    #[Groups(['invoice_create', 'invoice_view', 'invoice_update'])]
    private ?Product $product = null;

    public function __construct(?array $data = null)
    {
        if (null !== $data) {
            $this->setLabel($data['label'] ?? null);
            $this->setQuantity($data['quantity'] ?? null);
            $this->setDiscount($data['discount'] ?? null);
            $this->setSectionRank($data['section_rank'] ?? null);
            $this->setPlanItemNumber($data['plan_item_number'] ?? null);
            $this->setProduct($data['product'] ?? null);
        }
    }

    public function getLabel(): ?string
    {
        return $this->label;
    }

    public function setLabel(?string $label): void
    {
        $this->label = $label;
    }

    public function getQuantity(): ?int
    {
        return $this->quantity;
    }

    public function setQuantity(?int $quantity): void
    {
        $this->quantity = $quantity;
    }

    public function getDiscount(): ?float
    {
        return $this->discount;
    }

    public function setDiscount(?float $discount): void
    {
        $this->discount = $discount;
    }

    public function getSectionRank(): ?int
    {
        return $this->sectionRank;
    }

    public function setSectionRank(?int $sectionRank): void
    {
        $this->sectionRank = $sectionRank;
    }

    public function getPlanItemNumber(): ?string
    {
        return $this->planItemNumber;
    }

    public function setPlanItemNumber(?string $planItemNumber): void
    {
        $this->planItemNumber = $planItemNumber;
    }

    public function getProduct(): ?Product
    {
        return $this->product;
    }

    public function setProduct(?Product $product): void
    {
        $this->product = $product;
    }
}
