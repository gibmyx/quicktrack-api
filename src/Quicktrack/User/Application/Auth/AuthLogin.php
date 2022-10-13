<?php

declare(strict_types=1);

namespace Quicktrack\User\Application\Auth;

use Quicktrack\User\Domain\Contract\AuthRepository;
use Quicktrack\User\Domain\Contract\UserRepository;
use Quicktrack\User\Domain\Services\UserFinder;
use Quicktrack\User\Domain\Services\ValidatePassword;
use Quicktrack\User\Domain\ValueObjects\UserEmail;
use Quicktrack\User\Domain\ValueObjects\UserPassword;

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
        $user = ($this->finder)(new UserEmail($request->email()));
        ($this->validatePassword)($user, new UserPassword($request->password()));
        $token = $this->repository->generateAuthToken($user);
        return [
            'user' => [
                "id" => $user->id()->value(),
                "name" => $user->name()->value(),
                "email" => $user->email()->value()
            ],
            'authorization' => [
                'access_token' => $token,
                'token_type' => 'bearer'
            ]
        ];
    }
}
