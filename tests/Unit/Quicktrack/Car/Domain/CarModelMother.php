<?php

declare(strict_types=1);

namespace Tests\Unit\Quicktrack\Car\Domain;

use Quicktrack\Car\Domain\ValueObjects\CarModel;
use Tests\Unit\Shared\Domain\NameMother;

final class CarModelMother
{
    public static function create(string $value): CarModel
    {
        return new CarModel($value);
    }

    public static function random(): CarModel
    {
        return self::create(
            NameMother::random()
        );
    }
}
