<?php

namespace Tests\Feature\Quicktrack\Car;

use Tests\Shared\Infrastructure\Laravel\TestCase;
use Tests\Unit\Quicktrack\Car\Domain\CarBrandMother;
use Tests\Unit\Quicktrack\Car\Domain\CarMother;

class CarPutControllerTest extends TestCase
{
    /**
     * @test
     */
    public function itShouldFindAnUpdateAnExistingCar()
    {
        $car = CarMother::random();
        $this->postJson('/api/car', $car->toArray());

        $car->changeBrand(CarBrandMother::random());

        $response = $this->putJson("/api/car/{$car->id()->value()}", $car->toArray());

        $response->assertStatus(200);
        $response->assertJson([
            'ok' => true,
            'content' => [],
            'errors' => []
        ]);
    }

    /**
     * @test
     */
    public function errorsArrayShouldHaveDomainNotFoundException()
    {
        $car = CarMother::random();
        $response = $this->putJson("/api/car/{$car->id()->value()}", $car->toArray());

        $response->assertStatus(400);
        $response->assertJson([
            'ok' => false,
            'content' => [],
            'errors' => [
                "There's not any car with ID {$car->id()->value()}"
            ]
        ]);
    }
}
