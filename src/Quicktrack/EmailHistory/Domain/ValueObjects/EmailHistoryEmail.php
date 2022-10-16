<?php

declare(strict_types=1);

namespace Quicktrack\EmailHistory\Domain\ValueObjects;

use Shared\Domain\ValueObjects\EmailValueObject;

final class EmailHistoryEmail extends EmailValueObject
{
    protected $exceptionMessage = "The Email can't be empty";
    protected $exceptionCode = 400;

    public function __construct(string $value)
    {
        $this->notEmpty($value);

        parent::__construct($value);
    }
}
