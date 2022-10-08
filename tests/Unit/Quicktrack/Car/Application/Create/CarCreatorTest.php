<?php

declare(strict_types=1);

namespace Tests\Unit\Quicktrack\Car\Application\Create;

use PHPUnit\Framework\MockObject\MockObject;
use Quicktrack\Car\Application\Create\CarCreator;
use Quicktrack\Car\Domain\Contract\CarRepository;
use Quicktrack\Car\Domain\Entity\Car;
use Tests\Unit\Quicktrack\Car\Domain\CarMother;
use Tests\TestCase;

final class CarCreatorTest extends TestCase {
    
    /** 
     * @test
    */
    public function itShouldCreateAValidCarAndReturnVoid()
    {
        $request = CarCreatorRequestMother::random();
        $car = CarMother::fromRequest($request);

        $repository = $this->createMock(CarRepository::class);
        $this->shouldSave($repository, $car);

        $response = (new CarCreator($repository))->__invoke($request);

        $this->assertNull($response);
    }

    private function shouldSave(MockObject $repository, Car $car): void
    {
        $repository->method('create')
            ->with($this->equalTo($car));
    }
}