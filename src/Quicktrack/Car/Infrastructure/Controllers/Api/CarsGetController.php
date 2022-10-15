<?php

declare(strict_types=1);

namespace Quicktrack\Car\Infrastructure\Controllers\Api;

use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Quicktrack\Car\Application\Search\CarSearcher;
use Quicktrack\Car\Application\Search\CarSearcherRequest;
use Shared\Domain\Errors;

final class CarsGetController extends Controller
{
    public function __construct(
        private CarSearcher $searcher
    )
    {
    }

    public function __invoke(Request $request): JsonResponse
    {
        $cars = ($this->searcher)(new CarSearcherRequest(
            $request->input('filters')
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
                    'cars' => $cars->toArray()
                ],
                'errors' => []
            ], 
            JsonResponse::HTTP_OK
        );
    }
}