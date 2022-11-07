<?php

declare(strict_types=1);

namespace Quicktrack\EmailNotification\Domain\Collection;

use Quicktrack\EmailNotification\Domain\Entity\EmailNotification;
use Shared\Domain\Collection;

final class EmailsNotification extends Collection
{
    public function __construct(
        array $items,
        private ?int $currentPage = null,
        private ?int $lastPage = null,
        private ?int $total = null
    ) {
        parent::__construct($items);
    }

    public function currentPage(): ?int
    {
        return $this->currentPage;
    }

    public function lastPage(): ?int
    {
        return $this->lastPage;
    }

    public function total(): ?int
    {
        return $this->total;
    }

    protected function type(): string
    {
        return EmailNotification::class;
    }
}
