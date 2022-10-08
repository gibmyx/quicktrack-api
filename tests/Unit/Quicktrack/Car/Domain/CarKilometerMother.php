<?php

declare(strict_types=1);

namespace Tests\Unit\Quicktrack\Car\Domain;

use Quicktrack\Car\Domain\ValueObjects\CarKilometer;
use Tests\Unit\Shared\Domain\FloatMother;

final class CarKilometerMother
{
    public static function create(float $value): CarKilometer
    {
        return new CarKilometer($value);
    }

    public static function random(): CarKilometer
    {
        return self::create(
            FloatMother::randomPositive()
        );
    }
}
