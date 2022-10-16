<?php

declare(strict_types=1);

namespace Tests\Feature\Quicktrack\EmailHistory;

use Tests\Shared\Infrastructure\Laravel\TestCase;
use Tests\Unit\Quicktrack\EmailHistory\Domain\EmailHistoryMother;

final class EmailHistoryGetControllerTest extends TestCase
{
    /**
     * @test
     */
    public function itShouldFindEmailHistory()
    {
        $emailHistory = EmailHistoryMother::random();
        $this->postJson('/api/email-history', $emailHistory->toArray());

        $response = $this->getJson("/api/email-history/{$emailHistory->id()->value()}", ['x-token' => $this->token]);

        $response->assertStatus(200);
        $response->assertJson([
            'ok' => true,
            'content' => [
                'emailHistory' => $emailHistory->toArray()
            ],
            'errors' => []
        ]);
    }
    /**
     * @test
     */
    public function itShouldDoNotFindEmailHistory()
    {
        $emailHistory = EmailHistoryMother::random();
        $response = $this->getJson("/api/email-history/{$emailHistory->id()->value()}", ['x-token' => $this->token]);

        $response->assertStatus(400);
        $response->assertJson([
            'ok' => false,
            'content' => [],
            'errors' => ["There's not any Email history with ID {$emailHistory->id()->value()}"]
        ]);
    }
}
