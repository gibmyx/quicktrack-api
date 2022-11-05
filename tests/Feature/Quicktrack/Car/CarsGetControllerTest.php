<?php

namespace Tests\Feature\Quicktrack\Car;

use Quicktrack\Car\Domain\Entity\Car;
use Tests\Shared\Infrastructure\Laravel\TestCase;
use Tests\Unit\Quicktrack\Car\Application\Search\CarSearcherRequestMother;
use Tests\Unit\Quicktrack\Car\Domain\CarMother;
use Tests\Unit\Quicktrack\Car\Domain\CarsMother;

class CarsGetControllerTest extends TestCase
{

    /**
     * @test
     */
    public function itShouldSearchAndFindAnExistingCar()
    {
        $car1 = CarMother::withStatus('sold');
        $car2 = CarMother::withStatus('sold');
        $car3 = CarMother::withStatus('available');
        $cars = CarsMother::create($car1, $car2, $car3);
        $request = CarSearcherRequestMother::byStatus('available');
        $query = http_build_query(['filters' => $request->filters()]);

        $cars->each(fn(Car $car) => $this->postJson('/api/car', $car->toArray(), ['x-token' => $this->token]));

        $response = $this->getJson(
            "/api/cars?page=1&limit=10&orderBy=code&order=asc&{$query}",
            ['x-token' => $this->token]
        );

        $response->assertStatus(200);
        $response->assertJson([
            'ok' => true,
            'content' => [
                'cars' => [
                    $car3->toArray(),
                ],
                "total" => 1,
                "lastPage" => 1,
                "currentPage" => 1
            ],
            'errors' => []
        ]);
    }

    /**
     * @test
     */
    /*public function errorsArrayShouldHaveDomainNotFoundException()
    {
        $id = UuidMother::random();
        $response = $this->getJson("/api/car/{$id}");

        $response->assertStatus(400);
        $response->assertJson([
            'ok' => false,
            'content' => [],
            'errors' => [
                "There's not any car with ID {$id}"
            ]
        ]);
    }*/
}
