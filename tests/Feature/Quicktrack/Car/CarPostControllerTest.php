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
    }
}
