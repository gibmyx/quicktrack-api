<?php

declare(strict_types=1);

namespace Shared\Application\Search;

class SearcherRequest
{
    public function __construct(
        private array $filters,
        private ?string $orderBy = null,
        private ?string $order = null,
        private ?int $limit = null
    ) {
    }

    public function filters(): array
    {
        return $this->filters;
    }

    public function orderBy(): ?string
    {
        return $this->orderBy;
    }

    public function order(): ?string
    {
        return $this->order;
    }

    public function limit(): ?int
    {
        return $this->limit;
    }
}
