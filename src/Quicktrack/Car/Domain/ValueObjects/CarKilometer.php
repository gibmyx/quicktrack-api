<?php

declare(strict_types=1);

namespace Quicktrack\Car\Domain\ValueObjects;

use Shared\Domain\ValueObjects\FloatValueObject;

final class CarKilometer extends FloatValueObject
{
    protected $exceptionMessage = "The car kilometer can't be empty";
    protected $exceptionCode = 401;

    public function __construct(float $value)
    {
        $this->notEmpty($value);

        parent::__construct($value);
    }
}