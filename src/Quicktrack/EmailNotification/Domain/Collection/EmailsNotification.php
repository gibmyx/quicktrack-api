<?php

declare(strict_types=1);

namespace Quicktrack\EmailNotification\Domain\Collection;

use Quicktrack\EmailNotification\Domain\Entity\EmailNotification;
use Shared\Domain\Collection;

final class EmailsNotification extends Collection
{
    public function __construct(
        array $items
    )
    {
        parent::__construct($items);
    }

    protected function type(): string
    {
        return EmailNotification::class;
    }
}
