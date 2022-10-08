<?php

declare(strict_types=1);

namespace Tests\Unit\Quicktrack\Car\Domain;

use Quicktrack\Car\Domain\ValueObjects\CarFuel;
use Quicktrack\Car\Domain\ValueObjects\CarStatus;
use Tests\Unit\Shared\Domain\NameMother;
use Tests\Unit\Shared\Domain\SelectMother;

final class CarStatusMother
{
    public static function create(string $value): CarStatus
    {
        return new CarStatus($value);
    }

    public static function random(): CarStatus
    {
        return self::create(
            SelectMother::fromValues(['available', 'sold'])
        );
    }
}
