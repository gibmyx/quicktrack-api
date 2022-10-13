<?php

declare(strict_types=1);

namespace Tests\Feature\Quicktrack\User;

use Tests\TestCase;
use Illuminate\Testing\Fluent\AssertableJson;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Quicktrack\User\Infrastructure\Eloquent\Models\User;

final class LoginControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function itShouldAuthorizeTheUser()
    {
        $user = User::factory()->create();
        $response = $this->postJson('/api/auth/login', [
            'email' => $user->email,
            'password' => 'password'
        ]);

        $response
            ->assertStatus(200)
            ->assertJsonPath('ok', true)
            ->assertJsonPath('content.user.id', $user->id)
            ->assertJsonPath('content.user.name', $user->name)
            ->assertJsonPath('content.user.email', $user->email);
    }

    /**
     * @test
     */
    public function itShoulNotAutorizationUser()
    {
        $response = $this->postJson('/api/auth/login', [
            'email' => 'user@gmail.com',
            'password' => 'password'
        ]);

        $response
            ->assertStatus(400)
            ->assertJsonPath('ok', false);
    }
}
