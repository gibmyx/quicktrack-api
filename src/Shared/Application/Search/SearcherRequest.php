<?php

declare(strict_types=1);

namespace Shared\Application\Search;

class SearcherRequest
{
    private $filters;

    public function __construct(
        array $filters
    )
    {
        $this->filters = $filters;
    }

    public function filters(): array
    {
        return $this->filters;
    }
}
