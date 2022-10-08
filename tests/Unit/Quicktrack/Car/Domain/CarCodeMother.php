<?php

declare(strict_types=1);

namespace Tests\Unit\Quicktrack\Car\Domain;

use Quicktrack\Car\Domain\ValueObjects\CarCode;
use Tests\Unit\Shared\Domain\CodeMother;

final class CarCodeMother
{
    public static function create(string $value): CarCode
    {
        return new CarCode($value);
    }

    public static function random(): CarCode
    {
        return self::create(
            CodeMother::random()
        );
    }
}
