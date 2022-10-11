<?php

declare(strict_types=1);

namespace Quicktrack\Car\Application\Find;

use Quicktrack\Car\Domain\ValueObjects\CarId;
use Quicktrack\Car\Domain\Contract\CarRepository;
use Quicktrack\Car\Domain\Services\CarFinder as ServicesCarFinder;

final class CarFinder
{
    private $repository;
    private $finder;

    public function __construct(
        CarRepository $repository
    )
    {
        $this->repository = $repository;
        $this->finder = new ServicesCarFinder($repository);
    }

    public function __invoke(
        CarFinderRequest $request
    )
    {
        return ($this->finder)(new CarId($request->id()));
    }
}