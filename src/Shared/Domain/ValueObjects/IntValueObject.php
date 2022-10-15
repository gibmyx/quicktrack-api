<?php

declare(strict_types=1);

namespace Shared\Domain\ValueObjects;

use Shared\Domain\Exceptions\EmptyArgumentException;

class IntValueObject extends ValueObject
{
    public function __construct(private int $value)
    {
    }

    public function value(): int
    {
        return $this->value;
    }

    public function equals(self $newValue): bool
    {
        return $this->value === $newValue->value();
    }

    protected function notEmpty(int $value): void
    {
        if (empty($value))
            $this->addError(
                new EmptyArgumentException($this->exceptionMessage, $this->exceptionCode)
            );
    }
}
