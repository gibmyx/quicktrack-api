<?php

declare(strict_types=1);

namespace Quicktrack\User\Domain\ValueObjects;

use Shared\Domain\ValueObjects\IntValueObject;

final class UserId extends IntValueObject
{
    protected $exceptionMessage = "The id can't be empty";
    protected $exceptionCode = 401;

    public function __construct(int $value)
    {
        $this->notEmpty($value);

        parent::__construct($value);
    }
}
