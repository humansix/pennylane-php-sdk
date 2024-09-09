<?php
namespace Pennylane\Sdk\DTO;

use Doctrine\Common\Collections\ArrayCollection;

class ListInvoices implements PaginationInterface
{

    private ?int $currentPage = null;

    private ?int $totalPages = null;

    private ?int $totalInvoices = null;

    private \SplObjectStorage $invoices;

    public function __construct(?array $data = null)
    {
        $this->invoices = new \SplObjectStorage();
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

    public function getInvoices(): \SplObjectStorage
    {
        return $this->invoices;
    }

    public function setInvoices(array $invoices): void
    {
        foreach ($invoices as $invoice) {
            $this->addInvoice(new Invoice($invoice));
        }
    }

    public function addInvoice(Invoice $invoice): void
    {
        $this->invoices->attach($invoice);
    }

    public function getItems(): \SplObjectStorage
    {
        return $this->getInvoices();
    }
}