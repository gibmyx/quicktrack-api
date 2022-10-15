<?php

namespace Tests\Feature\Quicktrack\Car;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\Unit\Quicktrack\Car\Domain\CarMother;

class CarGetControllerTest extends TestCase
{
    use DatabaseTransactions;

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
}
