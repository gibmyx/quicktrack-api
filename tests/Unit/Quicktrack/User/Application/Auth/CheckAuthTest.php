<?php

declare(strict_types=1);

namespace Tests\Unit\Quicktrack\User\Application\Auth;

use PHPUnit\Framework\MockObject\MockObject;
use Quicktrack\User\Application\Auth\CheckAuth;
use Quicktrack\User\Domain\Contract\AuthRepository;
use Quicktrack\User\Domain\ValueObjects\UserToken;
use Tests\Shared\Infrastructure\Laravel\TestCase;
use Tests\Unit\Quicktrack\User\Domain\UserTokenMother;

final class CheckAuthTest extends TestCase
{
    /**
     * @test
     */
    public function itShouldCheckAuthTrue()
    {
        $token = UserTokenMother::random();
        $request = CheckAuthRequestMother::create($token);
        $repository = $this->createMock(AuthRepository::class);
        $this->shouldResponseReposiroty($repository, $token, true);

        $response = (new CheckAuth($repository))->__invoke($request);
        $this->assertEquals(true, $response);
    }

    /**
     * @test
     */
    public function itShouldCheckAuthFalse()
    {
        $token = UserTokenMother::random();
        $request = CheckAuthRequestMother::create($token);
        $repository = $this->createMock(AuthRepository::class);
        $this->shouldResponseReposiroty($repository, $token, false);

        $response = (new CheckAuth($repository))->__invoke($request);
        $this->assertEquals(false, $response);
    }

    private function shouldResponseReposiroty(
        MockObject $repository,
        UserToken $token,
        bool $result
    ): void {
        $repository->method('validateAuthToken')
            ->with($token)
            ->willReturn($result);
    }
}
