<?php

declare(strict_types=1);

namespace Quicktrack\User\Application\Auth;

use Quicktrack\User\Domain\Contract\AuthRepository;
use Quicktrack\User\Domain\Contract\UserRepository;
use Quicktrack\User\Domain\Services\UserFinder;
use Quicktrack\User\Domain\ValueObjects\UserEmail;
use Quicktrack\User\Domain\ValueObjects\UserToken;

final class RefreshAuth
{
    private UserFinder $finder;

    public function __construct(
        private AuthRepository $repository,
        private UserRepository $userRepository
    ) {
        $this->finder = new UserFinder($userRepository);
    }

    public function __invoke(RefreshAuthRequest $request): array
    {
        $payload = $this->repository->decodeToken(new UserToken($request->token()));
        $user = ($this->finder)(new UserEmail($payload['data']->email));
        return $this->repository->generateAuthToken($user);
    }
}
