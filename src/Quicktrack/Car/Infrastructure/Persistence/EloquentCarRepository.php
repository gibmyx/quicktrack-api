<?php

declare(strict_types=1);

namespace Quicktrack\Car\Infrastructure\Persistence;

use DateTime;
use Quicktrack\Car\Domain\Entity\Car;
use Quicktrack\Car\Domain\ValueObjects\CarId;
use Quicktrack\Car\Domain\Contract\CarRepository;
use Quicktrack\Car\Infrastructure\Eloquent\Models\Car as ModelsCar;

final class EloquentCarRepository implements CarRepository
{
    public function create(Car $car): void
    {
        ModelsCar::create($car->toArray());
    }

    public function update(Car $car): void
    {
        $car = ModelsCar::find($car->id()->value());

        if ($car) {
            $car->update($car->toArray());
        }
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
            (float)$modelsCar->kilometer,
            (float)$modelsCar->price,
            $modelsCar->type,
            $modelsCar->year,
            $modelsCar->status,
            $modelsCar->created_at->format('Y-m-d H:i:s'),
            $modelsCar->updated_at->format('Y-m-d H:i:s'),
        );
    }

    public function matching(array $filters): array
    {
        return [];
    }
}
