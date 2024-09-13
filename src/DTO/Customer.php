<?php

namespace Pennylane\Sdk\DTO;

use Symfony\Component\Serializer\Annotation\Groups;

class Customer
{
    #[Groups(['invoice_create', 'invoice_view'])]
    private ?string $sourceId = null;

    public function __construct(?array $data = null)
    {
        if (null !== $data) {
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
