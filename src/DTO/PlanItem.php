<?php

namespace Pennylane\Sdk\DTO;

use Symfony\Component\Serializer\Annotation\Groups;

class PlanItem
{
    #[Groups(['customer_list'])]
    private ?string $number = null;

    #[Groups(['customer_list'])]
    private ?string $label = null;

    #[Groups(['customer_list'])]
    private bool $enabled = true;

    #[Groups(['customer_list'])]
    private ?string $vatRate = null;

    #[Groups(['customer_list'])]
    private ?string $countryAlpha2 = null;

    #[Groups(['customer_list'])]
    private ?string $description = null;

    public function __construct(?array $data = null)
    {
        if (null !== $data) {
            $this->setNumber($data['number'] ?? null);
            $this->setLabel($data['label'] ?? null);
            $this->setEnabled($data['enabled'] ?? true);
            $this->setVatRate($data['vat_rate'] ?? null);
            $this->setCountryAlpha2($data['country_alpha2'] ?? null);
            $this->setDescription($data['description'] ?? null);
        }
    }

    public function getNumber(): ?string
    {
        return $this->number;
    }

    public function setNumber(?string $number): void
    {
        $this->number = $number;
    }

    public function getLabel(): ?string
    {
        return $this->label;
    }

    public function setLabel(?string $label): void
    {
        $this->label = $label;
    }

    public function isEnabled(): bool
    {
        return $this->enabled;
    }

    public function setEnabled(bool $enabled): void
    {
        $this->enabled = $enabled;
    }

    public function getVatRate(): ?string
    {
        return $this->vatRate;
    }

    public function setVatRate(?string $vatRate): void
    {
        $this->vatRate = $vatRate;
    }

    public function getCountryAlpha2(): ?string
    {
        return $this->countryAlpha2;
    }

    public function setCountryAlpha2(?string $countryAlpha2): void
    {
        $this->countryAlpha2 = $countryAlpha2;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): void
    {
        $this->description = $description;
    }
}
