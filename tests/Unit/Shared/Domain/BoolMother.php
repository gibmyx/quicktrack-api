<?php

declare(strict_types=1);

namespace Tests\Unit\Shared\Domain;

use Faker\Factory;

final class BoolMother
{
    public static function random(): bool
    {
        return Factory::create()->boolean();
    }
}
