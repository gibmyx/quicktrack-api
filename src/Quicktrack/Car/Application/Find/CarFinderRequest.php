<?php

declare(strict_types=1);

namespace Quicktrack\Car\Application\Find;

final class CarFinderRequest
{
    private $id;

    public function __construct(
        string $id
    )
    {
        $this->id = $id;
    }

    public function id(): string
    {
        return $this->id;
    }
}