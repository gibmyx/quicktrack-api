<?php

declare(strict_types=1);

namespace Tests\Feature\Quicktrack\EmailHistory;

use Tests\Shared\Infrastructure\Laravel\TestCase;
use Tests\Unit\Quicktrack\EmailHistory\Domain\EmailHistoryMother;

final class EmailHistoryPostControllerTest extends TestCase
{
    /**
     * @test
     */
    public function itShouldCreateEmailHistory()
    {
        $emailHistory = EmailHistoryMother::random();
        $response = $this->postJson('/api/email-history', $emailHistory->toArray());

        $response->assertStatus(201);
        $response->assertJson([
            'ok' => true,
            'content' => [],
            'errors' => []
        ]);
    }

    /**
     * @test
     */
    public function itShouldCreateEmailHistoryWithEmailEmpty()
    {
        $emailHistory = EmailHistoryMother::withEmailEmpty();
        $response = $this->postJson('/api/email-history', $emailHistory->toArray());

        $response->assertStatus(400);
        $response->assertJson([
            'ok' => false,
            'content' => [],
            'errors' => ["The Email can't be empty", "Email is invalid", "The Email can't be empty", "Email is invalid"]
        ]);
    }

    /**
     * @test
     */
    public function itShouldCreateEmailHistoryWithPhoneEmpty()
    {
        $emailHistory = EmailHistoryMother::withPhoneEmpty();
        $response = $this->postJson('/api/email-history', $emailHistory->toArray());

        $response->assertStatus(400);
        $response->assertJson([
            'ok' => false,
            'content' => [],
            'errors' => ["The Phone number can't be empty", "The Phone number can't be empty"]
        ]);
    }

    /**
     * @test
     */
    public function itShouldCreateEmailHistoryWithNameEmpty()
    {
        $emailHistory = EmailHistoryMother::withNameEmpty();
        $response = $this->postJson('/api/email-history', $emailHistory->toArray());

        $response->assertStatus(400);
        $response->assertJson([
            'ok' => false,
            'content' => [],
            'errors' => ["The Name can't be empty", "The Name can't be empty"]
        ]);
    }

    /**
     * @test
     */
    public function itShouldCreateEmailHistoryWithMessageEmpty()
    {
        $emailHistory = EmailHistoryMother::withMessageEmpty();
        $response = $this->postJson('/api/email-history', $emailHistory->toArray());

        $response->assertStatus(400);
        $response->assertJson([
            'ok' => false,
            'content' => [],
            'errors' => ["The Message can't be empty", "The Message can't be empty"]
        ]);
    }
}
