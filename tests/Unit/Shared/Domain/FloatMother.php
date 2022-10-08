<?php

declare(strict_types=1);

namespace Tests\Unit\Shared\Domain;

use Faker\Factory;

final class FloatMother
{
    public static function random(): float
    {
        return Factory::create()->randomNumber();
    }

    public static function randomPositive(): float
    {
        return Factory::create()->randomFloat(2, 1, 50000);
    }
}
