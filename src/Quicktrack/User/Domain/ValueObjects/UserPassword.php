<?php

declare(strict_types=1);


namespace Quicktrack\User\Domain\ValueObjects;

use Shared\Domain\ValueObjects\StringValueObject;

final class UserPassword extends StringValueObject
{
    protected $exceptionMessage = "The Password can't be empty";
    protected $exceptionCode = 400;

    public function __construct(string $value)
    {
        $this->notEmpty($value);

        parent::__construct($value);
    }
}
