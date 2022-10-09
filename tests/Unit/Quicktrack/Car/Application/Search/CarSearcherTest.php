<?php

declare(strict_types=1);

namespace Tests\Unit\Quicktrack\Car\Application\Search;

use Quicktrack\Car\Application\Search\CarSearcher;
use Quicktrack\Car\Domain\Contract\CarRepository;
use Quicktrack\Car\Domain\Entity\Car;
use Tests\TestCase;
use Tests\Unit\Quicktrack\Car\Domain\CarMother;
use Tests\Unit\Quicktrack\Car\Domain\CarsMother;

final class CarSearcherTest extends TestCase
{
    /**
     * @test
     */
    public function itShouldFindOneActiveCar()
    {
        $car1 = CarMother::withStatus('sold');
        $car2 = CarMother::withStatus('sold');
        $car3 = CarMother::withStatus('available');
        $response = CarsMother::create($car3);

        $repository = $this->createMock(CarRepository::class);
        $searcher = new CarSearcher($repository);

        $this->shouldSearchByPropEqualTo($repository, 'status', 'available', $car1, $car2, $car3);

        $this->assertEquals(
            $response,
            ($searcher)(CarSearcherRequestMother::byStatus('available'))
        );
    }

    private function shouldSearch(\PHPUnit\Framework\MockObject\MockObject $repository, Car ...$cars)
    {
        $repository->method('matching')
            ->willReturn($cars);
    }

    private function shouldSearchByPropEqualTo(\PHPUnit\Framework\MockObject\MockObject $repository, string $prop, string $value, Car ...$cars)
    {
        $filteredCars = array_filter(
            $cars, 
            fn(Car $car) => $car->$prop()->value() === $value
        );

        $repository->method('matching')
            ->willReturn(array_values($filteredCars));
    }
}