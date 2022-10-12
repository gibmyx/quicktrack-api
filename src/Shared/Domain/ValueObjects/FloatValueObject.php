<?php

declare(strict_types=1);

namespace Shared\Domain\ValueObjects;

use Shared\Domain\Exceptions\EmptyArgumentException;
use Shared\Domain\Exceptions\InvalidArgumentException;

class FloatValueObject
{
    public function __construct(private float $value)
    {
    }

    public function value(): float
    {
        return $this->value;
    }

    public function equals(self $newValue): bool
    {
        return $this->value === $newValue->value();
    }

    public function onlyPositive(float $value): void
    {
        if (0.00 > $value)
            throw new InvalidArgumentException($this->exceptionMessage, $this->exceptionCode);
    }

    protected function notEmpty(float $value): void
    {
        if (empty($value))
            throw new EmptyArgumentException($this->exceptionMessage, $this->exceptionCode);
    }
}
