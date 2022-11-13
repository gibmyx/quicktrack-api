<?php

declare(strict_types=1);

namespace Shared\Domain\Criteria;

final class FilterValue
{
    public function __construct(
        protected string|array $value
    ) {
    }

    public function value(): string|array
    {
        return $this->value;
    }
}
