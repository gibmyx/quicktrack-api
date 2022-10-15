<?php

declare(strict_types=1);


namespace Quicktrack\User\Application\Auth;


final class RefreshAuthRequest
{
    public function __construct(
        private string $token
    ) {
    }

    public function token(): string
    {
        return $this->token;
    }

}
