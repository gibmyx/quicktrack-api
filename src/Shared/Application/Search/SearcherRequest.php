<?php

declare(strict_types=1);

namespace Shared\Application\Search;

class SearcherRequest
{
    public function __construct(
        private array $filters
    )
    {
        $this->filters = $filters;
    }

    public function filters(): array
    {
        return $this->filters;
    }
}
