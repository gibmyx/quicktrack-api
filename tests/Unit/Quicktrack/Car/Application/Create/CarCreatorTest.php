<?php

declare(strict_types=1);

namespace Tests\Unit\Quicktrack\Car\Application\Create;

use PHPUnit\Framework\MockObject\MockObject;
use Quicktrack\Car\Application\Create\CarCreator;
use Quicktrack\Car\Domain\Contract\CarRepository;
use Quicktrack\Car\Domain\Entity\Car;
use Shared\Domain\Errors;
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

    /** 
     * @test
    */
    public function itShouldHaveCarModelEmptyErrorMessage()
    {
        $request = CarCreatorRequestMother::withEmptyModel();
        $car = CarMother::fromRequest($request);

        $this->assertSame(
            [
                "The car model can't be empty",
                "The car model can't be empty"
            ],
            Errors::getInstance()->errorsMessage()
        );
    }

    /** 
     * @test
    */
    public function itShouldThrowInvalidArgumentException()
    {
        $request = CarCreatorRequestMother::withNegativeKilometer();
        $car = CarMother::fromRequest($request);

        $this->assertSame(
            [
                "The car kilometer can't be negative",
                "The car kilometer can't be negative"
            ],
            Errors::getInstance()->errorsMessage()
        );
    }

    

    private function shouldSave(MockObject $repository, Car $car): void
    {
        $repository->method('create')
            ->with($this->equalTo($car));
    }
}