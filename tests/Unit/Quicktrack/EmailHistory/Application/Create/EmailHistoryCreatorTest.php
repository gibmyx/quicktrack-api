<?php

declare(strict_types=1);

namespace Tests\Unit\Quicktrack\EmailHistory\Application\Create;

use Tests\TestCase;
use PHPUnit\Framework\MockObject\MockObject;
use Shared\Domain\Exceptions\InvalidEmailException;
use Shared\Domain\Exceptions\EmptyArgumentException;
use Quicktrack\EmailHistory\Domain\Entity\EmailHistory;
use Tests\Unit\Quicktrack\EmailHistory\Domain\EmailHistoryMother;
use Quicktrack\EmailHistory\Domain\Contract\EmailHistoryRepository;
use Quicktrack\EmailHistory\Application\Create\EmailHistoryCreator;

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
