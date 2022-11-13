<?php

declare(strict_types=1);

namespace Shared\Infrastructure\Persistence;

use Shared\Domain\Criteria\Criteria;
use Illuminate\Database\Eloquent\Builder;
use Shared\Domain\Criteria\Filter;

abstract class EloquentQueryFilters
{
    protected $request;

    protected $builder;

    protected function apply(Builder $builder, Criteria $criteria): Builder
    {
        $this->builder = $builder;

        if (false === $criteria->hasFilters()) {
            return $this->builder;
        }

        $criteria->filters()->each(function (Filter $filter) {
            if(method_exists($this, $filter->field()->value())) {
                call_user_func_array([$this, $filter->field()->value()], array_filter([$filter->value()->value()]));
            }
        });

        return $this->builder;
    }

    function getValue($value): array
    {
        return is_array($value) ? $value : [$value];
    }

}
