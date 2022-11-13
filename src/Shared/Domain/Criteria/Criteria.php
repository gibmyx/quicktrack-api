<?php

declare(strict_types=1);

namespace Shared\Domain\Criteria;

final class Criteria
{
    public function __construct(
        private Filters $filters,
        private Order $order,
        private ?int $limit
    ) {
    }

    public function hasFilters(): bool
    {
        return $this->filters->count() > 0;
    }

    public function hasOrder(): bool
    {
        return !$this->order->isNone();
    }

    public function filters(): Filters
    {
        return $this->filters;
    }

    public function order(): Order
    {
        return $this->order;
    }

    public function limit(): ?int
    {
        return $this->limit;
    }
}
