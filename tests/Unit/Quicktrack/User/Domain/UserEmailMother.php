<?php

declare(strict_types=1);

namespace Tests\Unit\Quicktrack\User\Domain;

use Quicktrack\User\Domain\ValueObjects\UserEmail;
use Tests\Unit\Shared\Domain\EmailMother;
use Tests\Unit\Shared\Domain\UuidMother;

final class UserEmailMother
{
    public static function create(string $id): UserEmail
    {
        return new UserEmail($id);
    }

    public static function random()
    {
        return self::create(
            EmailMother::random()
        );
    }
}
