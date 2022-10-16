<?php

declare(strict_types=1);

namespace Tests\Unit\Quicktrack\User\Application\Auth;

use Quicktrack\User\Application\Auth\RefreshAuthRequest;
use Quicktrack\User\Domain\ValueObjects\UserToken;

final class RefreshAuthRequestMother
{
    public static function create(UserToken $token): RefreshAuthRequest
    {
        return new RefreshAuthRequest($token->value());
    }
}
