<?php

declare(strict_types=1);

namespace Quicktrack\Car\Infrastructure\Controllers\Api;

use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use Quicktrack\Car\Application\Find\CarFinder;
use Quicktrack\Car\Application\Find\CarFinderRequest;
use Shared\Domain\Errors;

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

        if (Errors::getInstance()->hasErrors()) {
            return new JsonResponse(
                [
                    'ok' => false,
                    'content' => [],
                    'errors' => Errors::getInstance()->errorsMessage()
                ], 
                JsonResponse::HTTP_BAD_REQUEST
            );
        }

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