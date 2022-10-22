<?php

declare(strict_types=1);

namespace Quicktrack\EmailNotification\Domain\ValueObjects;

use Shared\Domain\ValueObjects\StringValueObject;

final class EmailNotificationName extends StringValueObject
{
    protected $exceptionMessage = "The name can't be empty";
    protected $exceptionCode = 401;

    public function __construct(string $value)
    {
        $this->notEmpty($value);

        parent::__construct($value);
    }
}
