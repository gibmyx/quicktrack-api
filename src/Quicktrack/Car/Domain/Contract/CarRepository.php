<?php

declare(strict_types=1);

namespace Quicktrack\Car\Domain\Contract;

use Quicktrack\Car\Domain\Collection\Cars;
use Quicktrack\Car\Domain\Entity\Car;
use Quicktrack\Car\Domain\ValueObjects\CarId;
use Shared\Domain\Criteria\Criteria;

interface CarRepository
{
    public function create(Car $car): void;
    public function update(Car $car): void;
    public function find(CarId $carId): ?Car;
    public function matching(Criteria $criteria): Cars;
}
