<?php

declare(strict_types=1);

namespace Quicktrack\Brand\Domain\Contract;

use Quicktrack\Brand\Domain\Collection\Brands;
use Quicktrack\Brand\Domain\Entity\Brand;
use Quicktrack\Brand\Domain\ValueObjects\BrandId;
use Shared\Domain\Criteria\Criteria;

interface BrandRepository
{
    public function matching(Criteria $criteria): Brands;
    public function find(BrandId $brandId): ?Brand;
    public function create(Brand $brand): void;
    public function update(Brand $brand): void;
}
