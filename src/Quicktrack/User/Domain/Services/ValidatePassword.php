<?php

declare(strict_types=1);


namespace Quicktrack\User\Domain\Services;


use Quicktrack\User\Domain\Contract\UserRepository;
use Quicktrack\User\Domain\Entity\User;
use Quicktrack\User\Domain\ValueObjects\UserPassword;
use Shared\Domain\Exceptions\InvalidArgumentException;

final class ValidatePassword
{
    public function __construct(
        private UserRepository $repository
    ) {
    }

    public function __invoke(
        User $user,
        UserPassword $password
    ) {
        $isValid = $this->repository->validatePasssword($user, $password);

        if (false === $isValid) {
            throw new InvalidArgumentException("The credentials do not match", 400);
        }
    }
}
