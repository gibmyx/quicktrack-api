<?php

namespace Tests\Feature\Quicktrack\Car;

use Tests\Shared\Infrastructure\Laravel\TestCase;
use Tests\Unit\Quicktrack\Car\Domain\CarMother;
use Tests\Unit\Shared\Domain\UuidMother;

class CarGetControllerTest extends TestCase
{
    /**
     * @test
     */
    public function itShouldFindAnExistingCar()
    {
        $car = CarMother::random();
        $this->postJson('/api/car', $car->toArray(), ['x-token' => $this->token]);

        $response = $this->getJson("/api/car/{$car->id()->value()}", ['x-token' => $this->token]);

        $response->assertStatus(200);
        $response->assertJson([
            'ok' => true,
            'content' => [
                'car' => $car->toArray()
            ],
            'errors' => []
        ]);
    }

    /**
     * @test
     */
    public function errorsArrayShouldHaveDomainNotFoundException()
    {
        $id = UuidMother::random();
        $response = $this->getJson("/api/car/{$id}", ['x-token' => $this->token]);

        $response->assertStatus(400);
        $response->assertJson([
            'ok' => false,
            'content' => [],
            'errors' => [
                "There's not any car with ID {$id}"
            ]
        ]);
    }
}
