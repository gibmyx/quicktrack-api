<?php

declare(strict_types=1);

namespace Quicktrack\EmailNotification\Domain\ValueObjects;

use Shared\Domain\ValueObjects\EmailValueObject;

final class EmailNotificationEmail extends EmailValueObject
{
    protected $exceptionMessage = "The email can't be empty";
    protected $exceptionCode = 401;

    public function __construct(string $value)
    {
        $this->notEmpty($value);

        parent::__construct($value);
    }
}
