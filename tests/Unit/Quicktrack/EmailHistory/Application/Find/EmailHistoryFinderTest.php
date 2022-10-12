<?php

declare(strict_types=1);

namespace Tests\Unit\Quicktrack\EmailHistory\Application\Find;

use PHPUnit\Framework\MockObject\MockObject;
use Quicktrack\EmailHistory\Application\Find\EmailHistoryFinder;
use Quicktrack\EmailHistory\Application\Find\EmailHistoryFinderRequest;
use Quicktrack\EmailHistory\Domain\Contract\EmailHistoryRepository;
use Quicktrack\EmailHistory\Domain\Entity\EmailHistory;
use Shared\Domain\Exceptions\DomainNotExistsException;
use Tests\TestCase;
use Tests\Unit\Quicktrack\EmailHistory\Domain\EmailHistoryMother;
use Tests\Unit\Shared\Domain\UuidMother;

final class EmailHistoryFinderTest extends TestCase
{
    /**
     * @test
     */
    public function itShouldFindAEmailHistory()
    {
        $car = EmailHistoryMother::random();
        $request = EmailHistoryFinderRequestMother::withId($car->id()->value());

        $repository = $this->createMock(EmailHistoryRepository::class);
        $this->shouldFind($repository, $car);

        $response = (new EmailHistoryFinder($repository))->__invoke($request);

        $this->assertEquals($car, $response);
    }

    /**
     * @test
     */
    public function itShouldThrowDomainNotExistException()
    {
        $this->expectException(DomainNotExistsException::class);

        $request = EmailHistoryFinderRequestMother::withId(UuidMother::random());

        $repository = $this->createMock(EmailHistoryRepository::class);
        $this->shouldNotFind($repository, $request);

        (new EmailHistoryFinder($repository))->__invoke($request);
    }

    private function shouldFind(
        MockObject $repository,
        EmailHistory $emailHistory
    ): void {
        $repository->method('find')
            ->with($this->equalTo($emailHistory->id()))
            ->willReturn($emailHistory);
    }

    private function shouldNotFind(
        EmailHistoryRepository $repository,
        EmailHistoryFinderRequest $request
    ): void {

    }
}
