<?php

declare(strict_types=1);

namespace Tests\Unit\Quicktrack\User\Domain;

use Quicktrack\User\Domain\ValueObjects\UserName;
use Tests\Unit\Shared\Domain\NameMother;
use Tests\Unit\Shared\Domain\UuidMother;

final class UserNameMother
{
    public static function create(string $id): UserName
    {
        return new UserName($id);
    }

    public static function random()
    {
        return self::create(
            NameMother::random()
        );
    }
}
