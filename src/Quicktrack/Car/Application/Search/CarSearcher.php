<?php

declare(strict_types=1);

namespace Quicktrack\Car\Application\Search;

use Quicktrack\Car\Domain\Collection\Cars;
use Quicktrack\Car\Domain\Contract\CarRepository;
use Shared\Domain\Criteria\Criteria;
use Shared\Domain\Criteria\Filters;
use Shared\Domain\Criteria\Order;

final class CarSearcher
{
    public function __construct(
        private CarRepository $repository
    )
    {
    }

    public function __invoke(CarSearcherRequest $request): Cars
    {
        $criteria = new Criteria(
            Filters::fromValues($request->filters()),
            Order::fromValues($request->orderBy(), $request->order()),
            $request->limit()
        );

        return $this->repository->matching($criteria);
    }
}
