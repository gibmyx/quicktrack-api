<?php

declare(strict_types=1);

namespace Tests\Unit\Quicktrack\Car\Domain;

use Quicktrack\Car\Domain\Collection\Cars;
use Quicktrack\Car\Domain\Entity\Car;

final class CarsMother
{
    public static function create(
        Car ...$cars
    ): Cars
    {
        return new Cars($cars);
    }

    public static function random(): Cars
    {
        return self::create(
            CarMother::random(),
            CarMother::random(),
            CarMother::random(),
            CarMother::random(),
            CarMother::random(),
        );
    }
}
