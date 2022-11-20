<?php

declare(strict_types=1);

namespace Quicktrack\Brand\Infrastructure\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Quicktrack\Brand\Application\Find\BrandFinder;
use Quicktrack\Brand\Application\Find\BrandFinderRequest;
use Shared\Domain\Errors;

final class BrandGetController extends Controller
{
    public function __construct(
        private BrandFinder $finder
    ) {
    }

    public function __invoke(string $id): JsonResponse
    {
        $brand = ($this->finder)(new BrandFinderRequest($id));

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
                    'brand' => $brand->toArray()
                ],
                'errors' => []
            ],
            JsonResponse::HTTP_OK
        );
    }
}
