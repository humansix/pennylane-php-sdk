<?php

namespace Pennylane\Sdk\DTO;

use Symfony\Component\Serializer\Annotation\Groups;

class ListInvoices implements PaginationInterface
{
    #[Groups(['invoice_list'])]
    private ?int $currentPage = null;

    #[Groups(['invoice_list'])]
    private ?int $totalPages = null;

    #[Groups(['invoice_list'])]
    private ?int $totalInvoices = null;

    #[Groups(['invoice_list'])]
    private array $invoices = [];

    public function __construct(?array $data = null)
    {
        if (null !== $data) {
            $this->setCurrentPage($data['current_page'] ?? 0);
            $this->setTotalPages($data['total_pages'] ?? 0);
            $this->setTotalInvoices($data['total_invoices'] ?? 0);
            $this->setInvoices($data['invoices'] ?? []);
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

    public function getTotalInvoices(): int
    {
        return $this->totalInvoices;
    }

    public function getTotal(): int
    {
        return $this->getTotalInvoices();
    }

    public function setTotalInvoices(int $totalInvoices): void
    {
        $this->totalInvoices = $totalInvoices;
    }

    public function getInvoices(): array
    {
        return $this->invoices;
    }

    public function setInvoices(array $invoices): void
    {
        $this->invoices = array_map(fn ($invoice) => new Invoice($invoice), $invoices);
    }

    public function addInvoice(array $invoice): void
    {
        $this->invoices[] = $invoice;
    }

    public function getItems(): array
    {
        return $this->getInvoices();
    }
}
