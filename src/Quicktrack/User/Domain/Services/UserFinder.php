<?php

declare(strict_types=1);

namespace Quicktrack\User\Domain\Services;

use Quicktrack\User\Domain\Contract\UserRepository;
use Quicktrack\User\Domain\ValueObjects\UserEmail;
use Shared\Domain\Errors;
use Shared\Domain\Exceptions\DomainNotExistsException;

final class UserFinder
{
    public function __construct(
        private UserRepository $repository
    ) {
    }

    public function __invoke(
        UserEmail $email
    ) {
        $user = $this->repository->find($email);

        if (null === $user) {
            Errors::getInstance()->addError(
                new DomainNotExistsException("There's not any user with Email {$email->value()}", 400)
            );
        }

        return $user;
    }
}
