<?php

namespace Pennylane\Sdk\DTO;

use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Serializer\Attribute\Context;
use Symfony\Component\Serializer\Normalizer\DateTimeNormalizer;

class ImputationDates
{
    #[Groups(['invoice_create', 'invoice_view'])]
    #[Context([DateTimeNormalizer::FORMAT_KEY => 'Y-m-d'])]
    private ?\DateTime $startDate = null;

    #[Groups(['invoice_create', 'invoice_view'])]
    #[Context([DateTimeNormalizer::FORMAT_KEY => 'Y-m-d'])]
    private ?\DateTime $endDate = null;

    public function __construct(?array $data = null)
    {
        if (null !== $data) {
            if ($data['start_date'] instanceof \DateTime) {
                $this->setStartDate($data['start_date']);
            } else {
                $this->setStartDate(new \DateTime($data['start_date']) ?? null);
            }
            if ($data['end_date'] instanceof \DateTime) {
                $this->setEndDate($data['end_date']);
            } else {
                $this->setEndDate(new \DateTime($data['end_date']) ?? null);
            }
        }
    }

    public function getStartDate(): ?\DateTime
    {
        return $this->startDate;
    }

    public function setStartDate(?\DateTime $startDate): void
    {
        $this->startDate = $startDate;
    }

    public function getEndDate(): ?\DateTime
    {
        return $this->endDate;
    }

    public function setEndDate(?\DateTime $endDate): void
    {
        $this->endDate = $endDate;
    }
}
