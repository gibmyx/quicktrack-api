<?php

declare(strict_types=1);

namespace Quicktrack\Car\Infrastructure\Controllers\Api;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Quicktrack\Car\Application\Create\CarCreator;
use Quicktrack\Car\Application\Create\CarCreatorRequest;
use Shared\Domain\Errors;

final class CarPostController extends Controller
{
    public function __construct(
        private CarCreator $creator
    )
    {
    }

    public function __invoke(Request $request): JsonResponse
    {
        ($this->creator)(new CarCreatorRequest(
            $request->input('id'),
            $request->input('code'),
            $request->input('brand'),
            $request->input('model'),
            $request->input('color'),
            $request->input('fuel'),
            $request->input('gearbox'),
            $request->input('kilometer'),
            $request->input('price'),
            $request->input('type'),
            $request->input('year'),
            $request->input('status'),
        ));

        if (Errors::getInstance()->hasErrors()) {
            return new JsonResponse(
                [
                    'ok' => false,
                    'content' => [],
                    'errors' => Errors::getInstance()->errorsMessage()
                ], 
                Errors::getInstance()->errorsCode()
            );
        }

        return new JsonResponse(
            [
                'ok' => true,
                'content' => [],
                'errors' => []
            ], 
            JsonResponse::HTTP_OK
        );
    }
}