<?php

namespace Pennylane\Sdk\DTO;

use Symfony\Component\Serializer\Annotation\Groups;

class ListCustomers implements PaginationInterface
{
    #[Groups(['customer_list'])]
    private ?int $currentPage = null;

    #[Groups(['customer_list'])]
    private ?int $totalPages = null;

    #[Groups(['customer_list'])]
    private ?int $totalCustomers = null;

    #[Groups(['customer_list'])]
    private array $customers = [];

    public function __construct(?array $data = null)
    {
        if (null !== $data) {
            $this->setCurrentPage($data['current_page'] ?? 0);
            $this->setTotalPages($data['total_pages'] ?? 0);
            $this->setTotalCustomers($data['total_customers'] ?? 0);
            $this->setCustomers($data['customers'] ?? []);
        }
    }

    public function getTotalPages(): int
    {
        return $this->totalPages;
    }

    public function setTotalPages(int $totalPages): void
    {
        $this->totalPages = $totalPages;
    }

    public function getCurrentPage(): int
    {
        return $this->currentPage;
    }

    public function setCurrentPage(int $currentPage): void
    {
        $this->currentPage = $currentPage;
    }

    public function getTotalCustomers(): int
    {
        return $this->totalCustomers;
    }

    public function getTotal(): int
    {
        return $this->getTotalCustomers();
    }

    public function setTotalCustomers(int $totalCustomers): void
    {
        $this->totalCustomers = $totalCustomers;
    }

    public function getCustomers(): array
    {
        return $this->customers;
    }

    public function setCustomers(array $customers): void
    {
        $this->customers = array_map(fn ($invoice) => new Customer($invoice), $customers);
    }

    public function addInvoice(array $invoice): void
    {
        $this->customers[] = $invoice;
    }

    public function getItems(): array
    {
        return $this->getCustomers();
    }
}
