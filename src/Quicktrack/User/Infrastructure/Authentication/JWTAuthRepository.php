<?php

declare(strict_types=1);

namespace Quicktrack\User\Infrastructure\Authentication;

use Quicktrack\User\Domain\Contract\AuthRepository;
use Quicktrack\User\Domain\ValueObjects\UserToken;
use Quicktrack\User\Domain\Entity\User;

use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Firebase\JWT\SignatureInvalidException;
use Firebase\JWT\BeforeValidException;
use Firebase\JWT\ExpiredException;
use InvalidArgumentException;
use UnexpectedValueException;
use DomainException;

final class JWTAuthRepository implements AuthRepository
{
    private $key;
    private $jwtAlgo;

    public function __construct()
    {
        $this->key = env('JWT_SECRET');
        $this->jwtAlgo = env('JWT_ALGO');
    }

    public function generateAuthToken(User $user): array
    {
        $time = time();
        $timenbf = $time - 460;

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

        return [
            'user' => [
                "id" => $user->id()->value(),
                "name" => $user->name()->value(),
                "email" => $user->email()->value()
            ],
            'access_token' => JWT::encode($payload, $this->key, $this->jwtAlgo)
        ];
    }

    public function validateAuthToken(UserToken $token): bool
    {
        try {
            JWT::decode($token->value(), new Key($this->key, $this->jwtAlgo));
        } catch (ExpiredException $e) {
            return false;
        } catch (InvalidArgumentException $e) {
            return false;
        } catch (DomainException $e) {
            return false;
        } catch (SignatureInvalidException $e) {
            return false;
        } catch (BeforeValidException $e) {
            return false;
        } catch (UnexpectedValueException $e) {
            return false;
        }
        return true;
    }

    public function decodeToken(UserToken $token): array
    {
        if ($this->validateAuthToken($token) == false) {
            return [];
        }

        return (array)JWT::decode($token->value(), new Key($this->key, $this->jwtAlgo));
    }
}
