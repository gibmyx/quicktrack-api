<?php

declare(strict_types=1);

namespace Tests\Unit\Quicktrack\User\Application\Auth;

use Quicktrack\User\Application\Auth\AuthLoginRequest;

final class AuthLoginRequestMother
{
    public static function loginRequest(string $email, string $password): AuthLoginRequest
    {
        return new AuthLoginRequest($email, $password);
    }
}
