<?php

declare(strict_types=1);

namespace Quicktrack\User\Domain\Contract;

use Quicktrack\User\Domain\Entity\User;

interface AuthRepository
{
    public function generateAuthToken(User $user): string;
}
