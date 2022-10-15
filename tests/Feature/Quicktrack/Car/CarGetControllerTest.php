<?php

namespace Tests\Feature\Quicktrack\Car;

use Tests\Shared\Infrastructure\Laravel\TestCase;
use Tests\Unit\Quicktrack\Car\Domain\CarMother;

class CarGetControllerTest extends TestCase
{
    /**
     * @test
     */
    public function itShouldFindAnExistingCar()
    {
        $car = CarMother::random();
        $this->postJson('/api/car', $car->toArray());

        $response = $this->getJson("/api/car/{$car->id()->value()}");

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
        $id = 'wrong-id';
        $response = $this->getJson("/api/car/{$id}");

        $response->assertStatus(400);
        $response->assertJson([
            'ok' => false,
            'content' => [],
            'errors' => [
                "Invalid uuid",
                "There's not any car with ID {$id}"
            ]
        ]);
    }
}
