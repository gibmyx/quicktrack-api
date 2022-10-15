<?php

declare(strict_types=1);

namespace Quicktrack\Car\Domain\ValueObjects;

use Shared\Domain\ValueObjects\FloatValueObject;

final class CarKilometer extends FloatValueObject
{
    protected $exceptionMessage = "The car kilometer can't be negative";
    protected $exceptionCode = 400;

    public function __construct(float $value)
    {
        $this->onlyPositive($value);

        parent::__construct($value);
    }
}