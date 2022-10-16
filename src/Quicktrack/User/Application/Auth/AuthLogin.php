<?php

declare(strict_types=1);

namespace Quicktrack\User\Application\Auth;

use Quicktrack\User\Domain\Contract\AuthRepository;
use Quicktrack\User\Domain\Contract\UserRepository;
use Quicktrack\User\Domain\Services\UserFinder;
use Quicktrack\User\Domain\Services\ValidatePassword;
use Quicktrack\User\Domain\ValueObjects\UserEmail;
use Quicktrack\User\Domain\ValueObjects\UserPassword;
use Shared\Domain\Errors;

final class AuthLogin
{
    private UserFinder $finder;
    private ValidatePassword $validatePassword;

    public function __construct(
        private AuthRepository $repository,
        private UserRepository $userRepository
    ) {
        $this->finder = new UserFinder($userRepository);
        $this->validatePassword = new ValidatePassword($userRepository);
    }

    public function __invoke(AuthLoginRequest $request): array
    {
        $userEmail = new UserEmail($request->email());
        $password = new UserPassword($request->password());

        if (!Errors::getInstance()->hasErrors()){
            $user = ($this->finder)($userEmail);
            ($this->validatePassword)($user, $password);
            return $this->repository->generateAuthToken($user);
        }

        return [];
    }
}
