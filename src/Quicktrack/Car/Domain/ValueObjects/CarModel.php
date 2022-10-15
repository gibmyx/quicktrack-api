<?php

declare(strict_types=1);

namespace Quicktrack\Car\Domain\ValueObjects;

use Shared\Domain\ValueObjects\StringValueObject;

final class CarModel extends StringValueObject
{
    protected $exceptionMessage = "The car model can't be empty";
    protected $exceptionCode = 400;

    public function __construct(string $value)
    {
        $this->notEmpty($value);

        parent::__construct($value);
    }
}