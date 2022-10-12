<?php

declare(strict_types=1);

namespace Shared\Domain\ValueObjects;

class BoolValueObject
{
    public function __construct(private bool $value)
    {
    }

    public function value(): bool
    {
        return $this->value;
    }

    public function equals(self $newValue): bool
    {
        return $this->value === $newValue->value();
    }
}
