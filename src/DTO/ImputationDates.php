<?php

namespace Pennylane\Sdk\DTO;

class ImputationDates
{
    private ?\DateTime $startDate = null;

    private ?\DateTime $endDate = null;

    public function __construct(?array $data = null)
    {
        if ($data !== null) {
            $this->setStartDate($data['start_date'] ?? null);
            $this->setEndDate($data['end_date'] ?? null);
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