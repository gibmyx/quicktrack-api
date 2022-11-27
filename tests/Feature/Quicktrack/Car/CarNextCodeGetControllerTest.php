<?php

namespace Tests\Feature\Quicktrack\Car;

use Tests\Shared\Infrastructure\Laravel\TestCase;
use Tests\Unit\Quicktrack\Car\Domain\CarMother;
use Tests\Unit\Shared\Domain\UuidMother;

class CarNextCodeGetControllerTest extends TestCase
{
    /**
     * @test
     */
    public function itShouldFindCodeForFirstCar()
    {
        $response = $this->getJson("/api/car-code", ['x-token' => $this->token]);

        $response->assertStatus(200);
        $response->assertJson([
            'ok' => true,
            'content' => [
                'code' => 'CR-0000001'
            ],
            'errors' => []
        ]);
    }

    /**
     * @test
     */
    public function itShouldFindCodeForNewCar()
    {
        $car = CarMother::withCode('CR-0000042');
        $this->postJson('/api/car', $car->toArray(), ['x-token' => $this->token]);

        $response = $this->getJson("/api/car-code", ['x-token' => $this->token]);

        $response->assertStatus(200);
        $response->assertJson([
            'ok' => true,
            'content' => [
                'code' => 'CR-0000043'
            ],
            'errors' => []
        ]);
    }

}
