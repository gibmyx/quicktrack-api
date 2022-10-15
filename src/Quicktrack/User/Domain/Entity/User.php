<?php

declare(strict_types=1);

namespace Quicktrack\User\Domain\Entity;

use Quicktrack\User\Domain\ValueObjects\UserId;
use Quicktrack\User\Domain\ValueObjects\UserName;
use Quicktrack\User\Domain\ValueObjects\UserEmail;

final class User
{
    private function __construct(
        private UserId $id,
        private UserName $name,
        private UserEmail $email
    ) {
    }

    public static function fromPrimitives(
        int $id,
        string $name,
        string $email
    ): self {
        return new self(
            new UserId($id),
            new UserName($name),
            new UserEmail($email)
        );
    }

    public static function create(
        UserId $id,
        UserName $name,
        UserEmail $email
    ): self {
        return new self(
            $id,
            $name,
            $email
        );
    }

    public function id(): UserId
    {
        return $this->id;
    }

    public function name(): UserName
    {
        return $this->name;
    }

    public function email(): UserEmail
    {
        return $this->email;
    }
}
