<?php

declare(strict_types=1);

namespace Tests\Unit\Quicktrack\User\Application\Auth;

use PHPUnit\Framework\MockObject\MockObject;
use Quicktrack\User\Application\Auth\RefreshAuth;
use Quicktrack\User\Domain\Contract\AuthRepository;
use Quicktrack\User\Domain\Contract\UserRepository;
use Quicktrack\User\Domain\Entity\User;
use Quicktrack\User\Domain\ValueObjects\UserToken;
use Tests\Shared\Infrastructure\Laravel\TestCase;
use Tests\Unit\Quicktrack\User\Domain\UserMother;
use Tests\Unit\Quicktrack\User\Domain\UserTokenMother;

final class RefreshAuthTest extends TestCase
{
    /**
     * @test
     */
    public function itShouldReturnNewToken()
    {
        $user = UserMother::random();
        $token = UserTokenMother::random();
        $request = RefreshAuthRequestMother::create($token);
        $userRepository = $this->createMock(UserRepository::class);
        $repository = $this->createMock(AuthRepository::class);

        $this->shouldDecodeToken($repository, $token, $user);
        $this->shouldFind($userRepository, $user);
        $this->shouldGenerateAuthToken($repository, $user);

        $response = (new RefreshAuth($repository, $userRepository))->__invoke($request);
        $this->assertSame($this->getResponse($user), $response);
    }

    private function shouldDecodeToken(
        MockObject $repository,
        UserToken $token,
        User $user
    ) {

        $repository->method('decodeToken')
            ->with($token)
            ->willReturn(['data' => ['email' => $user->email()->value()] ]);
    }

    private function shouldFind(
        MockObject $repository,
        User $user
    ): void {
        $repository->method('find')
            ->with($user->email())
            ->willReturn($user);
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
