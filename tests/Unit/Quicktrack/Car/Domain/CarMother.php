<?php

declare(strict_types=1);

namespace Tests\Unit\Quicktrack\Car\Domain;

use Quicktrack\Car\Application\Create\CarCreatorRequest;
use Quicktrack\Car\Domain\Entity\Car;
use Quicktrack\Car\Domain\ValueObjects\CarBrand;
use Quicktrack\Car\Domain\ValueObjects\CarCode;
use Quicktrack\Car\Domain\ValueObjects\CarColor;
use Quicktrack\Car\Domain\ValueObjects\CarFuel;
use Quicktrack\Car\Domain\ValueObjects\CarGearbox;
use Quicktrack\Car\Domain\ValueObjects\CarId;
use Quicktrack\Car\Domain\ValueObjects\CarKilometer;
use Quicktrack\Car\Domain\ValueObjects\CarModel;
use Quicktrack\Car\Domain\ValueObjects\CarPrice;
use Quicktrack\Car\Domain\ValueObjects\CarStatus;
use Quicktrack\Car\Domain\ValueObjects\CarType;
use Quicktrack\Car\Domain\ValueObjects\CarYear;
use Tests\Unit\Quicktrack\Car\Domain\CarBrandMother;
use Tests\Unit\Quicktrack\Car\Domain\CarCodeMother;
use Tests\Unit\Quicktrack\Car\Domain\CarColorMother;
use Tests\Unit\Quicktrack\Car\Domain\CarFuelMother;
use Tests\Unit\Quicktrack\Car\Domain\CarGearboxMother;
use Tests\Unit\Quicktrack\Car\Domain\CarIdMother;
use Tests\Unit\Quicktrack\Car\Domain\CarKilometerMother;
use Tests\Unit\Quicktrack\Car\Domain\CarModelMother;
use Tests\Unit\Quicktrack\Car\Domain\CarPriceMother;
use Tests\Unit\Quicktrack\Car\Domain\CarStatusMother;
use Tests\Unit\Quicktrack\Car\Domain\CarTypeMother;
use Tests\Unit\Quicktrack\Car\Domain\CarYearMother;

final class CarMother
{
    public static function create(
        CarId $id,
        CarCode $code,
        CarBrand $brand,
        CarModel $model,
        CarColor $color,
        CarFuel $fuel,
        CarGearbox $gearbox,
        CarKilometer $kilometer,
        CarPrice $price,
        CarType $type,
        CarYear $year,
        CarStatus $status
    ): Car
    {
        return Car::create(
            $id,
            $code,
            $brand,
            $model,
            $color,
            $fuel,
            $gearbox,
            $kilometer,
            $price,
            $type,
            $year,
            $status
        );
    }

    public static function random(): Car
    {
        return self::create(
            CarIdMother::random(),
            CarCodeMother::random(),
            CarBrandMother::random(),
            CarModelMother::random(),
            CarColorMother::random(),
            CarFuelMother::random(),
            CarGearboxMother::random(),
            CarKilometerMother::random(),
            CarPriceMother::random(),
            CarTypeMother::random(),
            CarYearMother::random(),
            CarStatusMother::random()
        );
    }

    public static function fromRequest(CarCreatorRequest $request): Car
    {
        return self::create(
            CarIdMother::create($request->id()),
            CarCodeMother::create($request->code()),
            CarBrandMother::create($request->brand()),
            CarModelMother::create($request->model()),
            CarColorMother::create($request->color()),
            CarFuelMother::create($request->fuel()),
            CarGearboxMother::create($request->gearbox()),
            CarKilometerMother::create($request->kilometer()),
            CarPriceMother::create($request->price()),
            CarTypeMother::create($request->type()),
            CarYearMother::create($request->year()),
            CarStatusMother::create($request->status())
        );
    }

    public static function withStatus(string $status): Car
    {
        return self::create(
            CarIdMother::random(),
            CarCodeMother::random(),
            CarBrandMother::random(),
            CarModelMother::random(),
            CarColorMother::random(),
            CarFuelMother::random(),
            CarGearboxMother::random(),
            CarKilometerMother::random(),
            CarPriceMother::random(),
            CarTypeMother::random(),
            CarYearMother::random(),
            CarStatusMother::create($status)
        );
    }

    public static function withKilometer(float $kilometer): Car
    {
        return self::create(
            CarIdMother::random(),
            CarCodeMother::random(),
            CarBrandMother::random(),
            CarModelMother::random(),
            CarColorMother::random(),
            CarFuelMother::random(),
            CarGearboxMother::random(),
            CarKilometerMother::create($kilometer),
            CarPriceMother::random(),
            CarTypeMother::random(),
            CarYearMother::random(),
            CarStatusMother::random()
        );
    }

    public static function withIdAndKilometer(string $id, float $kilometer): Car
    {
        return self::create(
            CarIdMother::create($id),
            CarCodeMother::random(),
            CarBrandMother::random(),
            CarModelMother::random(),
            CarColorMother::random(),
            CarFuelMother::random(),
            CarGearboxMother::random(),
            CarKilometerMother::create($kilometer),
            CarPriceMother::random(),
            CarTypeMother::random(),
            CarYearMother::random(),
            CarStatusMother::random()
        );
    }
}
