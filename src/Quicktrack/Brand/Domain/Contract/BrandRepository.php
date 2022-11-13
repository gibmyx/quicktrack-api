<?php

declare(strict_types=1);

namespace Quicktrack\Brand\Domain\Contract;

use Quicktrack\Brand\Domain\Collection\Brands;
use Shared\Domain\Criteria\Criteria;

interface BrandRepository
{
    public function matching(Criteria $criteria): Brands;
}
