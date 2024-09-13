<?php

namespace Pennylane\Sdk\DTO;

use Symfony\Component\Serializer\Annotation\Groups;

class LineItemsSection
{
    #[Groups(['invoice_create', 'invoice_view'])]
    private ?string $title = null;

    #[Groups(['invoice_create', 'invoice_view'])]
    private ?string $description = null;

    #[Groups(['invoice_create', 'invoice_view'])]
    private ?int $rank = null;

    public function __construct(?array $data = null)
    {
        if (null !== $data) {
            $this->setTitle($data['title'] ?? null);
            $this->setDescription($data['description'] ?? null);
            $this->setRank($data['rank'] ?? null);
        }
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(?string $title): void
    {
        $this->title = $title;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): void
    {
        $this->description = $description;
    }

    public function getRank(): ?int
    {
        return $this->rank;
    }

    public function setRank(?int $rank): void
    {
        $this->rank = $rank;
    }
}
