<?php

declare(strict_types=1);

namespace Quicktrack\Car\Infrastructure\Persistence;

use Quicktrack\Car\Domain\Entity\Car;
use Quicktrack\Car\Domain\ValueObjects\CarId;
use Quicktrack\Car\Domain\Contract\CarRepository;
use Quicktrack\Car\Infrastructure\Eloquent\Models\Car as ModelsCar;

final class EloquentCarRepository extends EloquentQueryCarFilters implements CarRepository
{
    public function create(Car $car): void
    {
        ModelsCar::create($car->toArray());
    }

    public function update(Car $car): void
    {
        $modelCar = ModelsCar::find($car->id()->value());

        if ($modelCar) {
            $modelCar->update($car->toArray());
        }
    }

    public function find(CarId $carId): ?Car
    {
        $modelsCar = ModelsCar::find($carId->value());

        if (! $modelsCar) {
            return null;
        }

        return $this->toEntity($modelsCar);
    }

    public function matching(array $filters): array
    {
        return $this->apply(ModelsCar::query(), $filters)
            ->get()
            ->map(fn(ModelsCar $modelsCar) => $this->toEntity($modelsCar))
            ->toArray();
    }

    public function last(): ?Car
    {
        $last = ModelsCar::latest()->first();

        if (! $last) {
            return null;
        }
        
        return $this->toEntity($last);
    }

    private function toEntity(ModelsCar $modelsCar): Car
    {
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
}
