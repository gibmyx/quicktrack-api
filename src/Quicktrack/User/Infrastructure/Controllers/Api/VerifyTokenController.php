<?php

declare(strict_types=1);

namespace Quicktrack\User\Infrastructure\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Quicktrack\User\Application\Auth\RefreshAuth;
use Quicktrack\User\Application\Auth\RefreshAuthRequest;

final class VerifyTokenController extends Controller
{
    public function __construct(
        private RefreshAuth $refreshAuth
    ) {
    }

    public function __invoke(Request $request): JsonResponse
    {
        try {
            $response = ($this->refreshAuth)(new RefreshAuthRequest($request->header('x-token')));
        } catch (\Exception $exception) {
            $code = $exception->getCode() === 0
                ? JsonResponse::HTTP_BAD_REQUEST
                : $exception->getCode();

            return new JsonResponse([
                'ok' => false,
                'content' => [],
                'errors' => [$exception->getMessage()]
            ], $code);
        }

        return new JsonResponse([
            'ok' => true,
            'content' => $response,
            'errors' => []
        ], JsonResponse::HTTP_OK);
    }
}
