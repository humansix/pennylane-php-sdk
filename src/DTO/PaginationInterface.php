<?php

namespace Pennylane\Sdk\DTO;

interface PaginationInterface
{
    public function getTotalPages(): int;

    public function getCurrentPage(): int;

    public function getTotal(): int;

    public function getItems(): array;
}
