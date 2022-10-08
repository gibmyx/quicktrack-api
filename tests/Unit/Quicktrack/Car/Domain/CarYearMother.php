<?php

declare(strict_types=1);

namespace Tests\Unit\Quicktrack\Car\Domain;

use Quicktrack\Car\Domain\ValueObjects\CarYear;
use Tests\Unit\Shared\Domain\DateTimeMother;

final class CarYearMother
{
    public static function create(string $value): CarYear
    {
        return new CarYear($value);
    }

    public static function random(): CarYear
    {
        return self::create(
            DateTimeMother::random()
        );
    }
}
