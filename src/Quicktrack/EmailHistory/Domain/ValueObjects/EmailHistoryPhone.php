<?php

declare(strict_types=1);

namespace Quicktrack\EmailHistory\Domain\ValueObjects;

use Shared\Domain\ValueObjects\StringValueObject;

final class EmailHistoryPhone extends StringValueObject
{
    protected $exceptionMessage = "The Phone number can't be empty";
    protected $exceptionCode = 400;

    public function __construct(string $value)
    {
        $this->notEmpty($value);

        parent::__construct($value);
    }
}
