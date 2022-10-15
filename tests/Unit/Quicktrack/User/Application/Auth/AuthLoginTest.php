<?php

declare(strict_types=1);

namespace Tests\Unit\Quicktrack\User\Application\Auth;

use Monolog\Test\TestCase;
use PHPUnit\Framework\MockObject\MockObject;
use Quicktrack\User\Application\Auth\AuthLogin;
use Quicktrack\User\Domain\Contract\AuthRepository;
use Quicktrack\User\Domain\Entity\User;
use Quicktrack\User\Domain\ValueObjects\UserPassword;
use Tests\Unit\Quicktrack\User\Domain\UserMother;
use Quicktrack\User\Domain\Contract\UserRepository;

final class AuthLoginTest extends TestCase
{
    /**
     * @test
     */
    public function itShouldReturnTokenForAuth()
    {
        $user = UserMother::random();
        $request = AuthLoginRequestMother::loginRequest($user->email()->value(), 'password');
        $userRepository = $this->createMock(UserRepository::class);
        $repository = $this->createMock(AuthRepository::class);
        $this->shouldFind($userRepository, $user);
        $this->shouldValidatePassword($userRepository, $user, new UserPassword('password'));
        $this->shouldGenerateAuthToken($repository, $user);

        $response = (new AuthLogin($repository, $userRepository))->__invoke($request);
        $this->assertSame($this->getResponse($user), $response);
    }

    private function shouldFind(
        MockObject $repository,
        User $user
    ): void {
        $repository->method('find')
            ->with($user->email())
            ->willReturn($user);
    }

    private function shouldValidatePassword(
        MockObject $repository,
        User $user,
        UserPassword $password,
        bool $result = true
    ): void {
        $repository->method('validatePasssword')
            ->with($user, $password)
            ->willReturn($result);
    }

    private function shouldGenerateAuthToken(
        MockObject $repository,
        User $user
    ): void {
        $repository->method('generateAuthToken')
            ->with($user)
            ->willReturn($this->getResponse($user));
    }

    private function getResponse(User $user): array
    {
        return [
            'user' => [
                "id" => $user->id()->value(),
                "name" => $user->name()->value(),
                "email" => $user->email()->value()
            ],
            'access_token' => "askdnaksldnmkjasdnkasldn"
        ];
    }

}
