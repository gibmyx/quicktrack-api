<?php

namespace Tests\Feature\Quicktrack\Car;

// use Illuminate\Foundation\Testing\RefreshDatabase;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Tests\Unit\Quicktrack\Car\Domain\CarMother;

class CarPostControllerTest extends TestCase
{
    //use DatabaseMigrations;
    use RefreshDatabase;

    /**
     * @test
     */
    public function itShouldCreateAndSaveAValidCar()
    {
        $car = CarMother::random();
        $response = $this->post('/api/car', $car->toArray());

        $response->assertStatus(200);
    }
}
