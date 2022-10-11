<?php

declare(strict_types=1);

namespace Tests\Unit\Quicktrack\Car\Domain;

use Quicktrack\Car\Domain\ValueObjects\CarPrice;
use Tests\Unit\Shared\Domain\FloatMother;
use Tests\Unit\Shared\Domain\NameMother;

final class CarPriceMother
{
    public static function create(float $value): CarPrice
    {
        return new CarPrice($value);
    }

    public static function random(): CarPrice
    {
        return self::create(
            FloatMother::randomPositive()
        );
    }
}
