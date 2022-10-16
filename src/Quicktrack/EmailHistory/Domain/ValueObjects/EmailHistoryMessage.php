<?php

declare(strict_types=1);

namespace Quicktrack\EmailHistory\Domain\ValueObjects;

use Shared\Domain\ValueObjects\StringValueObject;

final class EmailHistoryMessage extends StringValueObject
{
    protected $exceptionMessage = "The Message can't be empty";
    protected $exceptionCode = 400;

    public function __construct(string $value)
    {
        $this->notEmpty($value);

        parent::__construct($value);
    }
}
