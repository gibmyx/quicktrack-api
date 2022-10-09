<?php

declare(strict_types=1);

namespace Quicktrack\Car\Domain\Collection;

use Quicktrack\Car\Domain\Entity\Car;
use Shared\Domain\Collection;

final class Cars extends Collection
{
    public function __construct(
        array $items
    )
    {
        parent::__construct($items);
    }

    protected function type(): string
    {
        return Car::class;
    }
}