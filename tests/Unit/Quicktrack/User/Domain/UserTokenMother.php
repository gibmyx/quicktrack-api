<?php

declare(strict_types=1);

namespace Tests\Unit\Quicktrack\User\Domain;

use Quicktrack\User\Domain\ValueObjects\UserToken;
use Tests\Unit\Shared\Domain\NameMother;

final class UserTokenMother
{
    private static function create(
        string $token,
    ): UserToken {
        return new UserToken($token);
    }

    public static function random(): UserToken
    {
        return self::create(NameMother::random());
    }
}
