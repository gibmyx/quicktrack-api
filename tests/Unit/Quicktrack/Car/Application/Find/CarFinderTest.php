<?php

declare(strict_types=1);

namespace Tests\Unit\Quicktrack\Car\Application\Find;

use PHPUnit\Framework\MockObject\MockObject;
use Quicktrack\Car\Application\Find\CarFinder;
use Quicktrack\Car\Application\Find\CarFinderRequest;
use Quicktrack\Car\Domain\Contract\CarRepository;
use Quicktrack\Car\Domain\Entity\Car;
use Shared\Domain\Exceptions\DomainNotExistsException;
use Tests\Unit\Quicktrack\Car\Domain\CarMother;
use Tests\TestCase;
use Tests\Unit\Quicktrack\Car\Domain\CarIdMother;
use Tests\Unit\Shared\Domain\UuidMother;

final class CarFinderTest extends TestCase {
    
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
        $this->expectException(DomainNotExistsException::class);

        $car = CarMother::random();
        $request = CarFinderRequestMother::withId(UuidMother::random());

        $repository = $this->createMock(CarRepository::class);
        $this->shouldNotFind($repository, $request);

        (new CarFinder($repository))->__invoke($request);
    }

    /** 
     * @test
    */
    /*public function itShouldThrowInvalidArgumentException()
    {
        $this->expectException(InvalidArgumentException::class);

        CarCreatorRequestMother::withNegativeKilometer();
    }
*/
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