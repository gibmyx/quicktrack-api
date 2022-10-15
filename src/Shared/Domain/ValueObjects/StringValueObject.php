<?php

declare(strict_types=1);

namespace Shared\Domain\ValueObjects;

use Shared\Domain\Exceptions\EmptyArgumentException;

class StringValueObject extends ValueObject
{
    public function __construct(private string $value)
    {
    }

    public function value(): string
    {
        return $this->value;
    }

    public function equals(self $newValue): bool
    {
        return $this->value === $newValue->value();
    }

    protected function notEmpty(string $value): void
    {
        if (empty($value))
            $this->addError(
                new EmptyArgumentException($this->exceptionMessage, $this->exceptionCode)
            );
    }
}
