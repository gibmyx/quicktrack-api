<?php

declare(strict_types=1);

namespace Tests\Unit\Quicktrack\User\Application\Auth;

use Quicktrack\User\Application\Auth\CheckAuthRequest;
use Quicktrack\User\Domain\ValueObjects\UserToken;

final class CheckAuthRequestMother
{
    public static function create(UserToken $token): CheckAuthRequest
    {
        return new CheckAuthRequest($token->value());
    }
}
