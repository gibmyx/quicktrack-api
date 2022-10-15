<?php

declare(strict_types=1);

namespace Quicktrack\Car\Infrastructure\Controllers\Api;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Quicktrack\Car\Application\Find\CarFinder;
use Quicktrack\Car\Application\Find\CarFinderRequest;

final class CarGetController extends Controller
{
    public function __construct(
        private CarFinder $finder
    )
    {
    }

    public function __invoke(string $id): JsonResponse
    {
        $car = ($this->finder)(new CarFinderRequest(
            $id
        ));

        return new JsonResponse(
            [
                'ok' => true,
                'content' => [
                    'car' => $car->toArray()
                ],
                'errors' => []
            ], 
            JsonResponse::HTTP_OK
        );
    }
}