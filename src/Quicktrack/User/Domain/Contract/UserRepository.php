<?php

declare(strict_types=1);

namespace Quicktrack\User\Domain\Contract;

use Quicktrack\User\Domain\Entity\User;
use Quicktrack\User\Domain\ValueObjects\UserEmail;
use Quicktrack\User\Domain\ValueObjects\UserPassword;

interface UserRepository
{
    public function find(UserEmail $userEmail): ?User;
    public function validatePasssword(User $user, UserPassword $password): bool;
}
