<?php

declare(strict_types=1);

namespace Tests\Unit\Quicktrack\Car\Application\Update;

use Quicktrack\Car\Application\Update\CarUpdaterRequest;
use Tests\Unit\Quicktrack\Car\Domain\CarColorMother;
use Tests\Unit\Quicktrack\Car\Domain\CarBrandMother;
use Tests\Unit\Quicktrack\Car\Domain\CarFuelMother;
use Tests\Unit\Quicktrack\Car\Domain\CarGearboxMother;
use Tests\Unit\Quicktrack\Car\Domain\CarIdMother;
use Tests\Unit\Quicktrack\Car\Domain\CarKilometerMother;
use Tests\Unit\Quicktrack\Car\Domain\CarModelMother;
use Tests\Unit\Quicktrack\Car\Domain\CarPriceMother;
use Tests\Unit\Quicktrack\Car\Domain\CarStatusMother;
use Tests\Unit\Quicktrack\Car\Domain\CarTypeMother;
use Tests\Unit\Quicktrack\Car\Domain\CarYearMother;

final class CarUpdaterRequestMother
{
    public static function random(): CarUpdaterRequest
    {
        return new CarUpdaterRequest(
            CarIdMother::random()->value(),
            CarBrandMother::random()->value(),
            CarModelMother::random()->value(),
            CarColorMother::random()->value(),
            CarFuelMother::random()->value(),
            CarGearboxMother::random()->value(),
            CarKilometerMother::random()->value(),
            CarPriceMother::random()->value(),
            CarTypeMother::random()->value(),
            CarYearMother::random()->value(),
            CarStatusMother::random()->value()
        );
    }

    public static function withId(string $id): CarUpdaterRequest
    {
        return new CarUpdaterRequest(
            CarIdMother::create($id)->value(),
            CarBrandMother::random()->value(),
            CarModelMother::random()->value(),
            CarColorMother::random()->value(),
            CarFuelMother::random()->value(),
            CarGearboxMother::random()->value(),
            CarKilometerMother::random()->value(),
            CarPriceMother::random()->value(),
            CarTypeMother::random()->value(),
            CarYearMother::random()->value(),
            CarStatusMother::random()->value()
        );
    }
}