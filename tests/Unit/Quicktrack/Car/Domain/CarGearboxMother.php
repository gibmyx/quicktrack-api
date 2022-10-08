<?php

declare(strict_types=1);

namespace Tests\Unit\Quicktrack\Car\Domain;

use Quicktrack\Car\Domain\ValueObjects\CarFuel;
use Quicktrack\Car\Domain\ValueObjects\CarGearbox;
use Tests\Unit\Shared\Domain\NameMother;

final class CarGearboxMother
{
    public static function create(string $value): CarGearbox
    {
        return new CarGearbox($value);
    }

    public static function random(): CarGearbox
    {
        return self::create(
            NameMother::random()
        );
    }
}
