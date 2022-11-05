<?php

declare(strict_types=1);

namespace Quicktrack\Brand\Infrastructure\Persistence;

use Illuminate\Database\Eloquent\Builder;
use Shared\Infrastructure\Persistence\EloquentQueryFilters;

abstract class EloquentQueryBrandFilters extends EloquentQueryFilters
{
    public function name(string $name): Builder
    {
        return $this->builder->where('cars_brand.name', 'like', "%{$name}%");
    }
}
