<?php

declare(strict_types=1);

namespace Quicktrack\Car\Infrastructure\Controllers\Api;

use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use Quicktrack\Car\Application\Find\CarNextCodeFinder;
use Shared\Domain\Errors;

final class CarNextCodeGetController extends Controller
{
    public function __construct(
        private CarNextCodeFinder $codeFinder
    )
    {
    }

    public function __invoke(): JsonResponse
    {
        $code = ($this->codeFinder)();

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
                    'code' => $code->value()
                ],
                'errors' => []
            ],
            JsonResponse::HTTP_OK
        );
    }
}
