<?php

declare(strict_types=1);

namespace Shared\Infrastructure\Middleware;

use Closure;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Quicktrack\User\Application\Auth\CheckAuth;
use Quicktrack\User\Application\Auth\CheckAuthRequest;
use Shared\Domain\Exceptions\ApiAuthException;

final class ApiMiddleware
{
    public function __construct(
        private CheckAuth $checkAuth
    ) {
    }

    public function handle(Request $request, Closure $next): mixed
    {
        if (empty($request->header('x-token'))) {
            return $this->response();
        }

        if (!($this->checkAuth)(new CheckAuthRequest($request->header('x-token')))) {
            return $this->response();
        }

        return $next($request);
    }

    private function response(): JsonResponse
    {
        return new JsonResponse([
            'ok' => false,
            'content' => [],
            'errors' => ["unauthorized"]
        ], JsonResponse::HTTP_UNAUTHORIZED);
    }
}
