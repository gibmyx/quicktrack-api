<?php

declare(strict_types=1);

namespace Tests\Unit\Quicktrack\User\Domain;

use Quicktrack\User\Domain\ValueObjects\UserPassword;
use Tests\Unit\Shared\Domain\NameMother;

final class UserPasswordMother
{
    public static function create(string $password): UserPassword
    {
        return new UserPassword($password);
    }

    public static function random()
    {
        return self::create(
            NameMother::random()
        );
    }
}
