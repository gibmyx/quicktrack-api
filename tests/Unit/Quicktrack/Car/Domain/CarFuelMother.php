<?php

declare(strict_types=1);

namespace Tests\Unit\Quicktrack\Car\Domain;

use Quicktrack\Car\Domain\ValueObjects\CarFuel;
use Tests\Unit\Shared\Domain\NameMother;

final class CarFuelMother
{
    public static function create(string $value): CarFuel
    {
        return new CarFuel($value);
    }

    public static function random(): CarFuel
    {
        return self::create(
            NameMother::random()
        );
    }
}
