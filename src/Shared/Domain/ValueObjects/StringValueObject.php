<?php

declare(strict_types=1);

namespace Shared\Domain\ValueObjects;

use Shared\Domain\Exceptions\EmptyArgumentException;

class StringValueObject
{
    private $value;

    public function __construct(string $value)
    {
        $this->value = $value;
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
            throw new EmptyArgumentException($this->exceptionMessage, $this->exceptionCode);
    }
}