<?php

declare(strict_types=1);

namespace Tests\Feature\Quicktrack\User;

use Tests\Shared\Infrastructure\Laravel\TestCase;

final class VerifyTokenControllerTest extends TestCase
{
    /**
     * @test
     */
    public function itShouldValidateTokenAndReturnNewToken()
    {
        $response = $this->getJson('/api/auth/verify-token', ['x-token' => $this->token]);
        $response
            ->assertStatus(200)
            ->assertJsonPath('ok', true);
    }

    /**
     * @test
     */
    public function itShouldReturnMessageUnauthorized()
    {
        $response = $this->getJson('/api/auth/verify-token');
        $response
            ->assertStatus(401)
            ->assertJsonPath('ok', false)
            ->assertJsonPath('errors', ["unauthorized"]);
    }
}
