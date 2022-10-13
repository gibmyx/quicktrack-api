<?php

declare(strict_types=1);

namespace Quicktrack\User\Infrastructure\Repository;

use Quicktrack\User\Domain\Contract\AuthRepository;
use Quicktrack\User\Domain\Entity\User;

use Firebase\JWT\JWT;
use Firebase\JWT\Key;

final class JWTAuthRepository implements AuthRepository
{
    public function generateAuthToken(User $user): string
    {
        $time = time();
        $timenbf = $time - 460;

        $key = env('JWT_SECRET');
        $jwtAlgo = env('JWT_ALGO');

        $payload = [
            "iss" => getenv('APP_URL'), //emisor
            "sub" => $user->id()->value(),
            "iat" => $time,
            "nbf" => $timenbf,
            "exp" => $time + 60 * 60,
            "data" => [
                'id' => $user->id()->value(),
                'email' => $user->email()->value(),
                'name' => $user->name()->value()
            ]
        ];
        return JWT::encode($payload, $key, $jwtAlgo);
    }
}
