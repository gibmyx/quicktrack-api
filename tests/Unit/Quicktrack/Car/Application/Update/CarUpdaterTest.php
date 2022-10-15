<?php

declare(strict_types=1);

namespace Tests\Unit\Quicktrack\Car\Application\Update;

use PHPUnit\Framework\MockObject\MockObject;
use Quicktrack\Car\Application\Update\CarUpdater;
use Quicktrack\Car\Application\Update\CarUpdaterRequest;
use Quicktrack\Car\Domain\Contract\CarRepository;
use Quicktrack\Car\Domain\Entity\Car;
use Shared\Domain\Exceptions\DomainNotExistsException;
use Tests\Unit\Quicktrack\Car\Domain\CarMother;
use Tests\TestCase;
use Tests\Unit\Quicktrack\Car\Domain\CarIdMother;
use Tests\Unit\Shared\Domain\UuidMother;

final class CarUpdaterTest extends TestCase {
    /**
     * @test
     */
    public function itShouldUpdateAValidCarAndReturnNull()
    {
        $car = CarMother::random();
        $request = CarUpdaterRequestMother::withId($car->id()->value());

        $repository = $this->createMock(CarRepository::class);
        $this->shouldFind($repository, $car);
        $this->shouldSave($repository, $car);

        $response = (new CarUpdater($repository))->__invoke($request);

        $this->assertNull($response);
    }

    private function shouldSave(MockObject $repository, Car $car): void
    {
        $repository->method('update')
            ->with($this->equalTo($car));
    }

    private function shouldFind(MockObject $repository, Car $car): void
    {
        $repository->method('find')
            ->with($this->equalTo($car->id()))
            ->willReturn($car);
    }
}