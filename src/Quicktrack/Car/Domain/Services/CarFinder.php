<?php

declare(strict_types=1);

namespace Quicktrack\Car\Domain\Services;

use Quicktrack\Car\Domain\Contract\CarRepository;
use Quicktrack\Car\Domain\ValueObjects\CarId;
use Shared\Domain\Exceptions\DomainNotExistsException;

final class CarFinder
{
    public function __construct(
        private CarRepository $repository
    )
    {
    }

    public function __invoke(
        CarId $carId
    )
    {
        $car = $this->repository->find($carId);

        if (null === $car) {
            throw new DomainNotExistsException("There's not any car with ID {$carId->value()}");
        }

        return $car;
    }
}