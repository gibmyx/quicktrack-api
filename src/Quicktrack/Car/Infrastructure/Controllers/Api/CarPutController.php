<?php

declare(strict_types=1);

namespace Quicktrack\Car\Infrastructure\Controllers\Api;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Quicktrack\Car\Application\Update\CarUpdater;
use Quicktrack\Car\Application\Update\CarUpdaterRequest;
use Shared\Domain\Errors;

final class CarPutController extends Controller
{
    public function __construct(
        private CarUpdater $updater
    )
    {
    }

    public function __invoke(string $id, Request $request): JsonResponse
    {
        ($this->updater)(new CarUpdaterRequest(
            $id,
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