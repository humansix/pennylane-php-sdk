<?php

namespace Pennylane\Sdk\Result;

use Pennylane\Sdk\Api\ApiInterface;

class Paginated implements \Iterator
{
    protected int $position = 0;

    protected array $params;

    protected array $items;

    protected int $totalItems;

    protected int $totalPages;

    protected int $page = 1;

    protected int $perPage;

    public const PER_PAGE = 20;

    public function __construct(
        private readonly ApiInterface $api,
        private readonly string $method,
        array $filters = [],
    ) {
        $this->params = $filters + [
            'page' => 1,
            'per_page' => self::PER_PAGE,
        ];
        $reflectionMethod = new \ReflectionMethod(get_class($this->api), $this->method);
        $result = $reflectionMethod->invoke($this->api, $this->params);
        $this->items = $result->getItems();
        $this->totalItems = $result->getTotal();
        $this->totalPages = $result->getTotalPages();
        $this->page = $result->getCurrentPage();
        $this->perPage = self::PER_PAGE;

        return $this->items[$this->position];
    }

    public function rewind(): void
    {
        $this->position = 0;
    }

    public function current(): mixed
    {
        return $this->items[$this->position];
    }

    public function key(): int
    {
        return $this->position;
    }

    public function next(): void
    {
        if ($this->position + 1 >= $this->perPage && $this->totalPages >= $this->page) {
            ++$this->page;
            $this->position = 0;
            $this->params += [
                'page' => $this->page,
                'per_page' => self::PER_PAGE,
            ];
            $reflectionMethod = new \ReflectionMethod(get_class($this->api), $this->method);
            $result = $reflectionMethod->invoke($this->api, $this->params);
            $this->items = $result[$this->api->getResultNode()];
        } else {
            ++$this->position;
        }
    }

    public function valid(): bool
    {
        return isset($this->items[$this->position]);
    }
}
