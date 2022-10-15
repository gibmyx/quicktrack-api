<?php

declare(strict_types=1);

namespace Quicktrack\User\Application\Auth;

use Quicktrack\User\Domain\Contract\AuthRepository;
use Quicktrack\User\Domain\Services\ValidateToken;
use Quicktrack\User\Domain\ValueObjects\UserToken;

final class CheckAuth
{
    public function __construct(
        private AuthRepository $repository
    ) {
        $this->checkToken = new ValidateToken($repository);
    }

    public function __invoke(CheckAuthRequest $request): bool
    {
        return ($this->checkToken)(new UserToken($request->token()));
    }
}
