<?php

namespace Tests\Feature\Quicktrack\Car;

use Tests\Shared\Infrastructure\Laravel\TestCase;
use Tests\Unit\Quicktrack\Car\Domain\CarMother;

class CarPostControllerTest extends TestCase
{
    /**
     * @test
     */
    public function itShouldCreateAndSaveAValidCar()
    {
        $car = CarMother::random();
        $response = $this->postJson('/api/car', $car->toArray());

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
    public function errorsArrayShouldHaveInvalidArgumentException()
    {
        $car = CarMother::withKilometer(-40.5);
        $response = $this->postJson('/api/car', $car->toArray());

        $response->assertStatus(400);
        $response->assertJson([
            'ok' => false,
            'content' => [],
            'errors' => [
                "The car kilometer can't be negative"
            ]
        ]);
    }

    /**
     * @test
     */
    public function errorsArrayShouldHaveInvalidArgumentAndEmptyArgumentExceptions()
    {
        $car = CarMother::withIdAndKilometer('Wrong uuid', -40.5);
        $response = $this->postJson('/api/car', $car->toArray());

        $response->assertStatus(400);
        $response->assertJson([
            'ok' => false,
            'content' => [],
            'errors' => [
                "Invalid uuid",
                "The car kilometer can't be negative"
            ]
        ]);
    }
}
