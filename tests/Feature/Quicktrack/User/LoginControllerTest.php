<?php

declare(strict_types=1);

namespace Tests\Feature\Quicktrack\User;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Quicktrack\User\Infrastructure\Eloquent\Models\User;
use Tests\Shared\Infrastructure\Laravel\TestCase;

final class LoginControllerTest extends TestCase
{
    use DatabaseTransactions;

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
    public function itShouldValidateEmptyEmail()
    {
        $response = $this->postJson('/api/auth/login', [
            'email' => '',
            'password' => 'password'
        ]);

        $response
            ->assertStatus(400)
            ->assertJsonPath('ok', false)
            ->assertJsonPath('errors', ["The Email can't be empty", "Email is invalid"]);
    }

    /**
     * @test
     */
    public function itShouldValidateEmptyPassword()
    {
        $response = $this->postJson('/api/auth/login', [
            'email' => 'usuario@gmail.com',
            'password' => ''
        ]);

        $response
            ->assertStatus(400)
            ->assertJsonPath('ok', false)
            ->assertJsonPath('errors', ["The Password can't be empty"]);
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
