<?php

declare(strict_types=1);

namespace Tests\Unit\Quicktrack\User\Domain;

use Quicktrack\User\Domain\ValueObjects\UserId;
use Tests\Unit\Shared\Domain\NumberMother;

final class UserIdMother
{
    public static function create(int $id): UserId
    {
        return new UserId($id);
    }

    public static function random()
    {
        return self::create(
            NumberMother::random()
        );
    }
}
