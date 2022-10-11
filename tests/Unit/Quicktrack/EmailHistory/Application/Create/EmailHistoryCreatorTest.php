<?php

declare(strict_types=1);

namespace Tests\Unit\Quicktrack\EmailHistory\Application\Create;

use PHPUnit\Framework\MockObject\MockObject;
use Quicktrack\EmailHistory\Application\Create\EmailHistoryCreator;
use Quicktrack\EmailHistory\Domain\Contract\EmailHistoryRepository;
use Quicktrack\EmailHistory\Domain\Entity\EmailHistory;
use Tests\TestCase;
use Tests\Unit\Quicktrack\EmailHistory\Domain\EmailHistoryMother;

final class EmailHistoryCreatorTest extends TestCase
{
    /**
     * @test
     */
    public function itShouldCreateAValidEmailHistoryAndReturnVoid()
    {
        $request = EmailHistoryRequestMother::random();
        $emailHistory = EmailHistoryMother::fromRequest($request);

        $repository = $this->createMock(EmailHistoryRepository::class);
        $this->shouldSave($repository, $emailHistory);

        $response = (new EmailHistoryCreator($repository))->__invoke($request);

        $this->assertNull($response);
    }

    private function shouldSave(MockObject $repository, EmailHistory $emailHistory): void
    {
        $repository->method('create')
            ->with($this->equalTo($emailHistory));
    }
}
