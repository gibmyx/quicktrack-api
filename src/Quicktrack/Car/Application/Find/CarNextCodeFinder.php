<?php

declare(strict_types=1);

namespace Quicktrack\Car\Application\Find;

use Quicktrack\Car\Domain\Contract\CarRepository;
use Quicktrack\Car\Domain\Entity\Car;
use Quicktrack\Car\Domain\ValueObjects\CarCode;
use Shared\Application\Find\NextCodeFinder;

final class CarNextCodeFinder extends NextCodeFinder
{
    public function __construct(
        private CarRepository $repository
    )
    {
    }

    public function __invoke(): CarCode
    {
        $lastCar = $this->repository->last();

        if (! $lastCar) {
            $firstCarSequential = 1;

            return new CarCode(Car::PREFIX . '-' . $this->formatCodeSequential($firstCarSequential));
        }

        $exploded = explode('-', $lastCar->code()->value());
        $newCarCodeSequential = $this->formatCodeSequential(intval($exploded[1]) + 1);
        $newCarCode = Car::PREFIX . '-' . $newCarCodeSequential;

        return new CarCode($newCarCode);
    }

}