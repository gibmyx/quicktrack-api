<?php

declare(strict_types=1);

namespace Tests\Unit\Quicktrack\Car\Application\Find;

use PHPUnit\Framework\MockObject\MockObject;
use Quicktrack\Car\Application\Find\CarFinder;
use Quicktrack\Car\Application\Find\CarFinderRequest;
use Quicktrack\Car\Domain\Contract\CarRepository;
use Quicktrack\Car\Domain\Entity\Car;
use Shared\Domain\Errors;
use Tests\Shared\Infrastructure\Laravel\TestCase;
use Tests\Unit\Quicktrack\Car\Domain\CarMother;
use Tests\Unit\Quicktrack\Car\Domain\CarIdMother;
use Tests\Unit\Shared\Domain\UuidMother;

final class CarFinderTest extends TestCase
{
    
    /** 
     * @test
    */
    public function itShouldFindACar()
    {
        $car = CarMother::random();
        $request = CarFinderRequestMother::withId($car->id()->value());

        $repository = $this->createMock(CarRepository::class);
        $this->shouldFind($repository, $car);

        $response = (new CarFinder($repository))->__invoke($request);

        $this->assertEquals($car, $response);
    }

    /**
     * @test
     */
    public function itShouldThrowDomainNotExistException()
    {
        $car = CarMother::random();
        $id = UuidMother::random();
        $request = CarFinderRequestMother::withId($id);

        $repository = $this->createMock(CarRepository::class);
        $this->shouldNotFind($repository, $request);

        (new CarFinder($repository))->__invoke($request);

        $this->assertSame(
            [
                "There's not any car with ID {$id}"
            ],
            Errors::getInstance()->errorsMessage()
        );
    }

    private function shouldFind(MockObject $repository, Car $car): void
    {
        $repository->method('find')
            ->with($this->equalTo($car->id()))
            ->willReturn($car);
    }

    private function shouldNotFind(MockObject $repository, CarFinderRequest $request): void
    {
        $repository->method('find')
            ->with($this->equalTo(CarIdMother::create($request->id())))
            ->willReturn(null);
    }
}