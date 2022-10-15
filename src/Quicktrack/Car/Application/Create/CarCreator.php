<?php

declare(strict_types=1);

namespace Quicktrack\Car\Application\Create;

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
use Quicktrack\Car\Domain\Contract\CarRepository;
use Shared\Domain\Errors;

final class CarCreator
{
    public function __construct(
        private CarRepository $repository
    )
    {
    }

    public function __invoke(
        CarCreatorRequest $request
    )
    {
        $car = Car::create(
            new CarId($request->id()),
            new CarCode($request->code()),
            new CarBrand($request->brand()),
            new CarModel($request->model()),
            new CarColor($request->color()),
            new CarFuel($request->fuel()),
            new CarGearbox($request->gearbox()),
            new CarKilometer($request->kilometer()),
            new CarPrice($request->price()),
            new CarType($request->type()),
            CarYear::createFromFormat('Y', $request->year()),
            new CarStatus($request->status())
        );

        if (Errors::getInstance()->errors()) {
            return;
        }

        $this->repository->create($car);
    }
}