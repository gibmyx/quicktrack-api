<?php

declare(strict_types=1);

namespace Tests\Feature\Quicktrack\User;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Quicktrack\User\Infrastructure\Eloquent\Models\User;
use Tests\TestCase;

final class LoginControllerTest extends TestCase
{
//    use RefreshDatabase;

    /**
     * @test
     */
    public function itShouldAuthorizeTheUserAndReturnToken()
    {
        $user = User::factory()->create();
        $response = $this->postJson('/api/car', [
            'email' => $user->email,
            'password' => 'password'
        ]);

    }
}
