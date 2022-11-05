<?php

declare(strict_types=1);

namespace Quicktrack\Car\Infrastructure\Persistence;

use Shared\Domain\Criteria\Criteria;
use Quicktrack\Car\Domain\Entity\Car;
use Quicktrack\Car\Domain\Collection\Cars;
use Quicktrack\Car\Domain\ValueObjects\CarId;
use Quicktrack\Car\Domain\Contract\CarRepository;
use Quicktrack\Car\Infrastructure\Eloquent\Models\Car as ModelsCar;

use function Lambdish\Phunctional\map;

final class EloquentCarRepository extends EloquentQueryCarFilters implements CarRepository
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

        return $this->toEntity($modelsCar);
    }

    public function matching(Criteria $criteria): Cars
    {
        $query = $this->apply(ModelsCar::query(), $criteria);

        if ($criteria->hasOrder()) {
            $query->orderBy(
                $criteria->order()->orderBy()->value(),
                $criteria->order()->orderType()->value()
            );
        }

        $cars = $criteria->limit()
            ? $query->paginate($criteria->limit())
            : $query->get();

        return new Cars(
            map($this->toEachEntity(), $criteria->limit() ? $cars->items() : $query->get()),
            $criteria->limit() ? $cars->currentPage() : null,
            $criteria->limit() ? $cars->lastPage() : null,
            $criteria->limit() ? $cars->total() : null
        );
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

    private function toEachEntity(): callable
    {
        return function (ModelsCar $modelsCar) {
            return $this->toEntity($modelsCar);
        };
    }
}
