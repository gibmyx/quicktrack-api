<?php

declare(strict_types=1);


namespace Tests\Unit\Quicktrack\User\Domain;


use Quicktrack\User\Domain\Entity\User;
use Quicktrack\User\Domain\ValueObjects\UserEmail;
use Quicktrack\User\Domain\ValueObjects\UserId;
use Quicktrack\User\Domain\ValueObjects\UserName;

final class UserMother
{

    private static function create(
        UserId $id,
        UserName $name,
        UserEmail $email
    ): User {
        return User::create(
            $id,
            $name,
            $email
        );
    }

    public static function random(): User
    {
        return self::create(
            UserIdMother::random(),
            UserNameMother::random(),
            UserEmailMother::random(),
        );
    }
}
