<?php

declare(strict_types=1);

namespace Quicktrack\Car\Application\Update;

use Quicktrack\Car\Domain\Contract\CarRepository;
use Quicktrack\Car\Domain\Services\CarFinder;
use Quicktrack\Car\Domain\ValueObjects\CarBrand;
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

final class CarUpdater
{
    private $finder;

    public function __construct(
        private CarRepository $repository
    )
    {
        $this->finder = new CarFinder($repository);
    }

    public function __invoke(
        CarUpdaterRequest $request
    )
    {
        $car = ($this->finder)(new CarId($request->id()));

        $car->changeBrand(new CarBrand($request->brand()));
        $car->changeModel(new CarModel($request->model()));
        $car->changeColor(new CarColor($request->color()));
        $car->changeFuel(new CarFuel($request->fuel()));
        $car->changeGearbox(new CarGearbox($request->gearbox()));
        $car->changeKilometer(new CarKilometer($request->kilometer()));
        $car->changePrice(new CarPrice($request->price()));
        $car->changeType(new CarType($request->type()));
        $car->changeYear(new CarYear($request->year()));
        $car->changeStatus(new CarStatus($request->status()));

        $this->repository->update($car);
    }
}