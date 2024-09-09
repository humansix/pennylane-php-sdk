<?php

namespace Pennylane\Sdk\DTO;


class Customer
{
    private ?string $sourceId = null;

    public function __construct(?array $data = null)
    {
        if ($data !== null) {
            $this->setSourceId($data['source_id'] ?? null);
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
}