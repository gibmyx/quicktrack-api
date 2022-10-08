<?php

declare(strict_types=1);

namespace Tests\Unit\Quicktrack\Car\Application\Create;

use Quicktrack\Car\Application\Create\CarCreatorRequest;
use Quicktrack\Car\Domain\ValueObjects\CarColorMother;
use Tests\Unit\Quicktrack\Car\Domain\CarBrandMother;
use Tests\Unit\Quicktrack\Car\Domain\CarCodeMother;
use Tests\Unit\Quicktrack\Car\Domain\CarFuelMother;
use Tests\Unit\Quicktrack\Car\Domain\CarGearboxMother;
use Tests\Unit\Quicktrack\Car\Domain\CarIdMother;
use Tests\Unit\Quicktrack\Car\Domain\CarKilometerMother;
use Tests\Unit\Quicktrack\Car\Domain\CarModelMother;
use Tests\Unit\Quicktrack\Car\Domain\CarPriceMother;
use Tests\Unit\Quicktrack\Car\Domain\CarStatusMother;
use Tests\Unit\Quicktrack\Car\Domain\CarTypeMother;
use Tests\Unit\Quicktrack\Car\Domain\CarYearMother;

final class CarCreatorRequestMother
{
    public static function random(): CarCreatorRequest
    {
        return new CarCreatorRequest(
            CarIdMother::random()->value(),
            CarCodeMother::random()->value(),
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