<?php

namespace Tests\Feature\Quicktrack\Car;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\Unit\Quicktrack\Car\Domain\CarMother;

class CarPostControllerTest extends TestCase
{
    use DatabaseTransactions;

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
}
