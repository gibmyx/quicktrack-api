<?php

declare(strict_types=1);

namespace Quicktrack\Car\Infrastructure\Persistence;

use Illuminate\Database\Eloquent\Builder;
use Shared\Infrastructure\Persistence\EloquentQueryFilters;

abstract class EloquentQueryCarFilters extends EloquentQueryFilters
{
    public function status(string $status): Builder
    {
        return $this->builder->where('cars.status', $status);
    }
}