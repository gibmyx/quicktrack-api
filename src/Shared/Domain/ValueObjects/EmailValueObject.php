<?php

declare(strict_types=1);

namespace Shared\Domain\ValueObjects;

use Shared\Domain\Exceptions\InvalidEmailException;

class EmailValueObject extends StringValueObject
{
    public function __construct(string $value)
    {
        $this->ensureIsValidEmail($value);

        parent::__construct($value);
    }

    private function ensureIsValidEmail(string $value)
    {
        if (! filter_var($value, FILTER_VALIDATE_EMAIL))
            throw new InvalidEmailException("User email is invalid");
    }
}
