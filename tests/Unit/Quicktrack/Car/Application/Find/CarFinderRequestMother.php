<?php

declare(strict_types=1);

namespace Tests\Unit\Quicktrack\Car\Application\Find;

use Quicktrack\Car\Application\Find\CarFinderRequest;

final class CarFinderRequestMother
{
    public static function withId(string $id): CarFinderRequest
    {
        return new CarFinderRequest($id);
    }
}