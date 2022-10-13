<?php

declare(strict_types=1);


namespace Quicktrack\User\Domain\Services;


use Quicktrack\User\Domain\Contract\UserRepository;
use Quicktrack\User\Domain\Entity\User;
use Quicktrack\User\Domain\ValueObjects\UserEmail;
use Quicktrack\User\Domain\ValueObjects\UserPassword;
use Shared\Domain\Exceptions\DomainNotExistsException;

final class ValidatePassword
{
    public function __construct(
        private UserRepository $repository
    ) {
    }

    public function __invoke(
        User $user,
        UserPassword $passwor
    ) {
        $isValid = $this->repository->validatePasssword($user, $passwor);

        if (false === $isValid) {
            throw new DomainNotExistsException("The credentials do not match", 400);
        }
    }
}
