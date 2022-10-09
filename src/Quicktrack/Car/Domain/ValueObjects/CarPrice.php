<?php

declare(strict_types=1);

namespace Quicktrack\Car\Domain\ValueObjects;

use Shared\Domain\ValueObjects\FloatValueObject;
use Shared\Domain\ValueObjects\StringValueObject;

final class CarPrice extends FloatValueObject
{
    protected $exceptionMessage = "The car price can't be negative";
    protected $exceptionCode = 401;

    public function __construct(float $value)
    {
        $this->onlyPositive($value);

        parent::__construct($value);
    }
}