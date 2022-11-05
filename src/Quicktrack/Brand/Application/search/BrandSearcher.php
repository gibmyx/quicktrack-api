<?php

declare(strict_types=1);

namespace Quicktrack\Brand\Application\search;

use Quicktrack\Brand\Domain\Collection\Brands;
use Quicktrack\Brand\Domain\Contract\BrandRepository;
use Shared\Domain\Criteria\Criteria;
use Shared\Domain\Criteria\Filters;
use Shared\Domain\Criteria\Order;

final class BrandSearcher
{
    public function __construct(
        private BrandRepository $repository
    ) {
    }

    public function __invoke(BrandSearcherRequest $request): Brands
    {
        $criteria = new Criteria(
            Filters::fromValues($request->filters()),
            Order::fromValues($request->orderBy(), $request->order()),
            $request->limit()
        );

        return $this->repository->matching($criteria);
    }
}
