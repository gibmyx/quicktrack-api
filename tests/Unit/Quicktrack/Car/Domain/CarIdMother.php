<?php

declare(strict_types=1);

namespace Tests\Unit\Quicktrack\Car\Domain;

use Quicktrack\Car\Domain\ValueObjects\CarId;
use Tests\Unit\Shared\Domain\UuidMother;

final class CarIdMother
{
    public static function create(string $id): CarId
    {
        return new CarId($id);
    }

    public static function random(): CarId
    {
        return self::create(
            UuidMother::random()
        );
    }
}
