<?php

declare(strict_types=1);

namespace Tests\Unit\Shared\Domain;

use Faker\Factory;

class DateTimeMother
{
    public static function random(): string
    {
        return Factory::create()->dateTimeBetween('-2 years', '+1 year')->format('Y-m-d H:i:s');
    }

    public static function randomYear(): string
    {
        return Factory::create()->dateTimeBetween('-2 years', '+1 year')->format('Y');
    }
}
