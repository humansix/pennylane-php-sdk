<?php

namespace Pennylane\Sdk\DTO;

use Doctrine\Common\Collections\ArrayCollection;

interface PaginationInterface
{
    public function getTotalPages(): int;

    public function getCurrentPage(): int;

    public function getTotal(): int;

    public function getItems(): \SplObjectStorage;
}