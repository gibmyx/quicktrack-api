<?php

declare(strict_types=1);

namespace Tests\Unit\Quicktrack\Car\Domain;

use Quicktrack\Car\Domain\ValueObjects\CarBrand;
use Tests\Unit\Shared\Domain\NameMother;

final class CarBrandMother
{
    public static function create(string $value): CarBrand
    {
        return new CarBrand($value);
    }

    public static function random(): CarBrand
    {
        return self::create(
            NameMother::random()
        );
    }
}
