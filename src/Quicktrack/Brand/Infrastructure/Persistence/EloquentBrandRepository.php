<?php

declare(strict_types=1);

namespace Quicktrack\Brand\Infrastructure\Persistence;

use Quicktrack\Brand\Domain\Entity\Brand;
use Quicktrack\Brand\Domain\Collection\Brands;
use Quicktrack\Brand\Domain\Contract\BrandRepository;
use Quicktrack\Brand\Infrastructure\Eloquent\Models\Brand as ModelsBrand;
use Shared\Domain\Criteria\Criteria;
use function Lambdish\Phunctional\map;

final class EloquentBrandRepository extends EloquentQueryBrandFilters implements BrandRepository
{
    public function matching(Criteria $criteria): Brands
    {
        $query = $this->apply(ModelsBrand::query(), $criteria);

        if ($criteria->hasOrder()) {
            $query->orderBy(
                $criteria->order()->orderBy()->value(),
                $criteria->order()->orderType()->value()
            );
        }

        $brands = $criteria->limit()
            ? $query->paginate($criteria->limit())
            : $query->get();

        return new Brands(
            map($this->toEachEntity(), $criteria->limit() ? $brands->items() : $query->get()),
            $criteria->limit() ? $brands->currentPage() : null,
            $criteria->limit() ? $brands->lastPage() : null,
            $criteria->limit() ? $brands->total() : null
        );
    }

    private function toEntity(ModelsBrand $modelsBrand): Brand
    {
        return Brand::fromPrimitives(
            $modelsBrand->id,
            $modelsBrand->value,
            $modelsBrand->name
        );
    }

    private function toEachEntity(): callable
    {
        return function (ModelsBrand $modelsBrand) {
            return $this->toEntity($modelsBrand);
        };
    }
}
