<?php

declare(strict_types=1);

namespace Quicktrack\Car\Application\Search;

use Quicktrack\Car\Domain\Collection\Cars;
use Quicktrack\Car\Domain\Contract\CarRepository;

final class CarSearcher
{
    private $repository;

    public function __construct(CarRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(CarSearcherRequest $request): Cars
    {
        return new Cars
            ($this->repository->matching($request->filters())
        );
    }
}