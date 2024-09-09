<?php

namespace Pennylane\Sdk\DTO;

use Symfony\Component\Serializer\Annotation\SerializedName;

class LineItemsSectionAttributes
{
    #[SerializedName('title')]
    private string $title;

    #[SerializedName('description')]
    private string $description;

    #[SerializedName('rank')]
    private int $rank;

    public function __construct(array $data)
    {
        $this->title = $data['title'];
        $this->description = $data['description'];
        $this->rank = $data['rank'];
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