<?php

declare(strict_types=1);

namespace Quicktrack\Car\Application\Find;

final class CarFinderRequest
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