<?php

declare(strict_types=1);

namespace Quicktrack\Brand\Domain\Services;

use Quicktrack\Brand\Domain\Contract\BrandRepository;
use Quicktrack\Brand\Domain\Entity\Brand;
use Quicktrack\Brand\Domain\ValueObjects\BrandId;
use Shared\Domain\Errors;
use Shared\Domain\Exceptions\DomainNotExistsException;

final class BrandFinder
{
    public function __construct(
        private BrandRepository $repository
    ) {
    }

    public function __invoke(
        BrandId $carId
    ): ?Brand {
        $car = $this->repository->find($carId);

        if (null === $car) {
            Errors::getInstance()->addError(
                new DomainNotExistsException("There's not any brand with ID {$carId->value()}", 400)
            );
        }

        return $car;
    }
}
