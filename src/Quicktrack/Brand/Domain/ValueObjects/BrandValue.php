<?php

declare(strict_types=1);

namespace Quicktrack\Brand\Domain\ValueObjects;

use Shared\Domain\ValueObjects\StringValueObject;

final class BrandValue extends StringValueObject
{
    protected $exceptionMessage = "The Value can't be empty";
    protected $exceptionCode = 400;

    public function __construct(string $value)
    {
        $this->notEmpty($value);

        parent::__construct($value);
    }
}
