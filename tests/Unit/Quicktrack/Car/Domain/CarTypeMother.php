<?php

declare(strict_types=1);

namespace Tests\Unit\Quicktrack\Car\Domain;

use Quicktrack\Car\Domain\ValueObjects\CarType;
use Tests\Unit\Shared\Domain\NameMother;

final class CarTypeMother
{
    public static function create(string $value): CarType
    {
        return new CarType($value);
    }

    public static function random(): CarType
    {
        return self::create(
            NameMother::random()
        );
    }
}
