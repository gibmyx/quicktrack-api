<?php

declare(strict_types=1);

namespace Quicktrack\Brand\Application\Find;

final class BrandFinderRequest
{
   public function __construct(
        private string $id
    )
    {
    }

    public function id(): string
    {
        return $this->id;
    }
}
