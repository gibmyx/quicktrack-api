<?php

declare(strict_types=1);

namespace Quicktrack\Car\Domain\ValueObjects;

use Tests\Unit\Shared\Domain\NameMother;

final class CarColorMother
{
    public static function create(string $value): CarColor
    {
        return new CarColor($value);
    }

    public static function random(): CarColor
    {
        return self::create(
            NameMother::random()
        );
    }
}