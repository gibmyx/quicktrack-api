<?php

declare(strict_types=1);

namespace Tests\Unit\Quicktrack\Car\Application\Find;

use PHPUnit\Framework\MockObject\MockObject;
use Quicktrack\Car\Application\Find\CarNextCodeFinder;
use Quicktrack\Car\Domain\Contract\CarRepository;
use Quicktrack\Car\Domain\Entity\Car;
use Tests\Shared\Infrastructure\Laravel\TestCase;
use Tests\Unit\Quicktrack\Car\Domain\CarCodeMother;
use Tests\Unit\Quicktrack\Car\Domain\CarMother;

final class CarNextCodeFinderTest extends TestCase
{
    
    /** 
     * @test
    */
    public function itShouldFindNextCodeForNewCar()
    {
        $car = CarMother::withCode('CR-0000081');

        $repository = $this->createMock(CarRepository::class);
        $this->shouldFindLastCar($repository, $car);

        $response = (new CarNextCodeFinder($repository))->__invoke();

        $this->assertEquals(CarCodeMother::create('CR-0000082'), $response);
    }

    /** 
     * @test
    */
    public function itShouldFindNextCodeForFirstCar()
    {
        $repository = $this->createMock(CarRepository::class);
        $this->shouldNotFoundLastCar($repository);

        $response = (new CarNextCodeFinder($repository))->__invoke();

        $this->assertEquals(CarCodeMother::create('CR-0000001'), $response);
    }

    private function shouldFindLastCar(MockObject $repository, Car $car): void
    {
        $repository->method('last')
            ->willReturn($car);
    }

    private function shouldNotFoundLastCar(MockObject $repository): void
    {
        $repository->method('last')
            ->willReturn(null);
    }
}