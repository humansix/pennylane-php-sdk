<?php

namespace Pennylane\Sdk\DTO;

use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Serializer\Annotation\SerializedName;

class Category
{
    #[Groups(['category'])]
    #[SerializedName('source_id')]
    private ?string $sourceId = null;

    #[Groups(['category'])]
    private ?string $weight = null;

    #[Groups(['category'])]
    private ?string $amount = null;

    public function __construct(?array $data = null)
    {
        if ($data !== null) {
            $this->setSourceId($data['source_id'] ?? null);
            $this->setWeight($data['weight'] ?? null);
            $this->setAmount($data['amount'] ?? null);
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

    public function getWeight(): ?string
    {
        return $this->weight;
    }

    public function setWeight(?string $weight): void
    {
        $this->weight = $weight;
    }

    public function getAmount(): ?string
    {
        return $this->amount;
    }

    public function setAmount(?string $amount): void
    {
        $this->amount = $amount;
    }
}