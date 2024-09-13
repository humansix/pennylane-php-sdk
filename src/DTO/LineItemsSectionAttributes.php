<?php

namespace Pennylane\Sdk\DTO;

use Symfony\Component\Serializer\Annotation\Groups;

class LineItemsSectionAttributes
{
    #[Groups(['invoice_create', 'invoice_view'])]
    private string $title;

    #[Groups(['invoice_create', 'invoice_view'])]
    private string $description;

    #[Groups(['invoice_create', 'invoice_view'])]
    private int $rank;

    public function __construct(?array $data = null)
    {
        if (null !== $data) {
            $this->setTitle($data['title'] ?? '');
            $this->setDescription($data['description'] ?? '');
            $this->setRank($data['rank'] ?? 0);
        }
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function getRank(): int
    {
        return $this->rank;
    }

    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    public function setRank(int $rank): void
    {
        $this->rank = $rank;
    }
}
