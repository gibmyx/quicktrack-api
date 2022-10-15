<?php

declare(strict_types=1);

namespace Quicktrack\User\Domain\Contract;

use Quicktrack\User\Domain\Entity\User;
use Quicktrack\User\Domain\ValueObjects\UserToken;

interface AuthRepository
{
    public function generateAuthToken(User $user): array;
    public function validateAuthToken(UserToken $token): bool;
    public function decodeToken(UserToken $token): array;
}
