<?php

declare(strict_types=1);

namespace Quicktrack\User\Domain\Services;

use Quicktrack\User\Domain\Contract\AuthRepository;
use Quicktrack\User\Domain\ValueObjects\UserToken;

final class ValidateToken
{
    public function __construct(
        private AuthRepository $repository
    ) {
    }

    public function __invoke(
        UserToken $token,
    ): bool {
        return $this->repository->validateAuthToken($token);
    }

}
