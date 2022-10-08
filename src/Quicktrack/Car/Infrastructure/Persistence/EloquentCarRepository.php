<?php

declare(strict_types=1);

namespace Quicktrack\Infrastructure\Repository;

use Quicktrack\Car\Domain\Entity\Car;
use Quicktrack\Car\Domain\ValueObjects\CarId;
use Quicktrack\Domain\Contract\CarRepository;
use Quicktrack\Infrastructure\Eloquent\Models\Car as ModelsCar;

final class EloquentCarRepository implements CarRepository
{
    public function create(Car $car): void
    {
        ModelsCar::create($car->toArray());
    }

    public function update(Car $car): void
    {
        ModelsCar::update($car->toArray());
    }

    public function find(CarId $carId): ?Car
    {
        $modelsCar = ModelsCar::find($carId->value());

        if (! $modelsCar) {
            return null;
        }

        return Car::fromPrimitives(
            $modelsCar->id,
            $modelsCar->code,
            $modelsCar->brand,
            $modelsCar->model,
            $modelsCar->color,
            $modelsCar->fuel,
            $modelsCar->gearbox,
            $modelsCar->kilometer,
            $modelsCar->price,
            $modelsCar->type,
            $modelsCar->year,
            $modelsCar->status,
            $modelsCar->createdAt,
            $modelsCar->updatedAt,
        )
    }

}