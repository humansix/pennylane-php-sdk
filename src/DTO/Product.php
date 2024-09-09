<?php
namespace Pennylane\Sdk\DTO;

class Product
{
    private ?string $sourceId;

    private ?float $price;

    private ?string $vatRate;

    private ?string $unit;

    public function __construct(?array $data = null)
    {
        if ($data !== null) {
            $this->setSourceId($data['source_id'] ?? null);
            $this->setPrice($data['price'] ?? null);
            $this->setVatRate($data['vat_rate'] ?? null);
            $this->setUnit($data['unit'] ?? null);
        }
    }

    public function getSourceId(): ?string
    {
        return $this->sourceId;
    }

    public function setSourceId(?string $sourceId): void
    {
        $this->sourceId = $sourceId;
    }

    public function getPrice(): ?float
    {
        return $this->price;
    }

    public function setPrice(?float $price): void
    {
        $this->price = $price;
    }

    public function getVatRate(): ?string
    {
        return $this->vatRate;
    }

    public function setVatRate(?string $vatRate): void
    {
        $this->vatRate = $vatRate;
    }

    public function getUnit(): ?string
    {
        return $this->unit;
    }

    public function setUnit(?string $unit): void
    {
        $this->unit = $unit;
    }
}