<?php

declare(strict_types=1);

namespace Quicktrack\User\Domain\ValueObjects;

use Shared\Domain\ValueObjects\StringValueObject;

final class UserToken extends StringValueObject
{
    protected $exceptionMessage = "The Token can't be empty";
    protected $exceptionCode = 401;

    public function __construct(string $value)
    {
        $this->notEmpty($value);
        parent::__construct($value);
    }
}
