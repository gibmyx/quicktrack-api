<?php

declare(strict_types=1);

namespace Tests\Unit\Quicktrack\Car\Application\Create;

use PHPUnit\Framework\MockObject\MockObject;
use Quicktrack\Car\Application\Create\CarCreator;
use Quicktrack\Car\Domain\Contract\CarRepository;
use Quicktrack\Car\Domain\Entity\Car;
use Shared\Domain\Errors;
use Shared\Domain\Exceptions\EmptyArgumentException;
use Shared\Domain\Exceptions\InvalidArgumentException;
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
    /* public function itShouldThrowEmptyArgumentException()
    {
        $request = CarCreatorRequestMother::withEmptyModel();
        $car = CarMother::fromRequest($request);

        $this->assertTrue(true);
        //Errors::getInstance()->errors();
    }

    /** 
     * @test
    */
    /*public function itShouldThrowInvalidArgumentException()
    {
        $request = CarCreatorRequestMother::withNegativeKilometer();
        $car = CarMother::fromRequest($request);
    } */

    

    private function shouldSave(MockObject $repository, Car $car): void
    {
        $repository->method('create')
            ->with($this->equalTo($car));
    }
}