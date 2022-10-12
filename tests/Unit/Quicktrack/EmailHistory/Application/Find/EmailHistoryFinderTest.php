<?php

declare(strict_types=1);

namespace Tests\Unit\Quicktrack\EmailHistory\Application\Find;

use Quicktrack\EmailHistory\Application\Find\EmailHistoryFinder;
use Tests\TestCase;
use PHPUnit\Framework\MockObject\MockObject;
use Quicktrack\EmailHistory\Domain\Entity\EmailHistory;
use Quicktrack\EmailHistory\Domain\Contract\EmailHistoryRepository;
use Tests\Unit\Quicktrack\EmailHistory\Domain\EmailHistoryMother;

final class EmailHistoryFinderTest extends TestCase
{
    /**
     * @test
     */
    public function itShouldFindACar()
    {
        $car = EmailHistoryMother::random();
        $request = EmailHistoryFinderRequestMother::withId($car->id()->value());

        $repository = $this->createMock(EmailHistoryRepository::class);
        $this->shouldFind($repository, $car);

        $response = (new EmailHistoryFinder($repository))->__invoke($request);

        $this->assertEquals($car, $response);
    }

    private function shouldFind(MockObject $repository, EmailHistory $emailHistory): void
    {
        $repository->method('find')
            ->with($this->equalTo($emailHistory->id()))
            ->willReturn($emailHistory);
    }
}
