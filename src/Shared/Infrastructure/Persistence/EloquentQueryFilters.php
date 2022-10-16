<?php

declare(strict_types=1);

namespace Shared\Infrastructure\Persistence;

use Illuminate\Database\Eloquent\Builder;

abstract class EloquentQueryFilters
{
    protected $request;

    protected $builder;

    protected function apply(Builder $builder, array $clause): Builder
    {
        $this->builder = $builder;

        foreach(array_filter($clause) as $filter){
            if(method_exists($this, $filter['field'])) {
                call_user_func_array([$this, $filter['field']], array_filter([$filter['value']]));
            }
        }
        return $this->builder;
    }

    function getValue($value): array
    {
        return is_array($value) ? $value : [$value];
    }

}
